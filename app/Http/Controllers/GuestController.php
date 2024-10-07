<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Guest;
use App\Models\GuestService;
use App\Models\RecurringService;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function guest_create()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // dd($userId);
            $Floors = Floor::where('admin_id', '=', $admin_id)->get();

            return view('admin_panel.guest_managment.guest_create', [
                'Floors' => $Floors,
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function guests()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            $guests = Guest::where('admin_id', $userId)
                ->with(['floor', 'room', 'services'])
                ->get();

            // Compute total service charges and update guests' total charges
            foreach ($guests as $guest) {
                // Convert string dates to Carbon instances
                $leaseFrom = Carbon::parse($guest->lease_from);
                $leaseTo = Carbon::parse($guest->lease_to);

                // Calculate the number of days for lease
                $days = $leaseFrom->diffInDays($leaseTo);

                // Calculate total service charges
                $totalServiceCharges = $guest->services->sum('amount');

                // Calculate total charges (room charges multiplied by number of days + total service charges)
                $guest->total_service_charges = $totalServiceCharges;
                $guest->total_charges = ($guest->room_charges * $days) + $totalServiceCharges;
            }

            $services = Service::where('admin_id', $userId)->get();
            return view('admin_panel.guest_managment.guests', compact('guests', 'services'));
        } else {
            return redirect()->back();
        }
    }



    public function get_rooms(Request $request)
    {
        // Retrieve rooms with 'Available' or 'Partially Booked' statuses
        $rooms = Room::where('floor_id', $request->floor_id)
            ->whereIn('occupancy_status', ['Available', 'Partially Booked'])
            ->get(['id', 'room_number', 'room_charges']);

        return response()->json($rooms);
    }


    public function getSeats(Request $request)
    {
        $roomId = $request->input('room_id');
        $seats = Seat::where('room_id', $roomId)->get();

        return response()->json($seats);
    }

    public function store_guest(Request $request)
    {
        $admin_id = Auth::id();

        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        // Handle file upload for CNIC Picture
        $cnicPicPath = $request->file('cnic_pic')->store('cnic_pictures', 'public');

        // Calculate total charges
        $leaseFrom = new \DateTime($request->lease_from);
        $leaseTo = new \DateTime($request->lease_to);
        $diffDays = $leaseFrom->diff($leaseTo)->days;

        // Retrieve room details
        $room = Room::find($request->room_id);
        $roomCharges = $room->room_charges;

        $totalCharges = $roomCharges * $diffDays;

        // Collect selected seat IDs from the request
        $selectedSeats = $request->input('seats', []); // This should be an array of seat IDs

        // Create a new guest record
        $guest = Guest::create([
            'admin_id' => $admin_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Encrypting the password for security
            'mobile' => $request->mobile,
            'cnic_pic' => $cnicPicPath,
            'id_type' => $request->id_type,
            'booking_date' => $request->booking_date,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'floor_id' => $request->floor_id,
            'room_id' => $request->room_id,  // Store the selected room ID
            'seats_id' => json_encode($selectedSeats), // Store the selected seat IDs as JSON
            'room_charges' => $roomCharges,  // Store the room charges
            'total_charges' => $totalCharges,
            'lease_from' => $request->lease_from,
            'lease_to' => $request->lease_to,
            'status' => 'Check-In',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Update the room and seat statuses
        $roomSeats = Seat::where('room_id', $request->room_id)->get();
        $bookedSeatsCount = $selectedSeats;

        // Update seat statuses
        foreach ($roomSeats as $seat) {
            if (in_array($seat->id, $bookedSeatsCount)) {
                // Update seat status to 'Booked'
                $seat->update(['status' => 'Booked']);
            } else {
                // Ensure remaining seats are available
                $seat->update(['status' => 'Available']);
            }
        }

        // Check if all seats in the room are booked
        $totalSeats = $roomSeats->count();
        $availableSeats = $roomSeats->where('status', 'Available')->count();

        if ($totalSeats == 0) {
            $occupancyStatus = 'Available';
        } elseif ($availableSeats == 0) {
            $occupancyStatus = 'Booked';
        } else {
            $occupancyStatus = 'Partially Booked';  // You can define this status if needed
        }

        // Update room occupancy status
        Room::where('id', $request->room_id)->update(['occupancy_status' => $occupancyStatus]);

        // Create a new user
        $user = User::create([
            'staff_id' => $guest->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => 'Guest',
        ]);

        return redirect()->back()->with('success', 'Guest booking has been confirmed and saved successfully.');
    }

    public function addService(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'service_info' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Split the service_info into service_id and service_name
        [$service_id, $service_name] = explode('|', $request->service_info);

        // Save both service_id and service_name to the guest_services table
        GuestService::create([
            'guest_id' => $request->guest_id,
            'service_id' => $service_id,
            'service_name' => $service_name,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Service added successfully!');
    }

    public function endBooking(Request $request)
    {
        // Validate the request
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
        ]);

        // Find the guest and update the status
        $guest = Guest::find($request->guest_id);
        if ($guest) {
            // Update the guest status
            $guest->status = 'Check-Out';
            $guest->save();

            // Update the room status to Available
            Room::where('id', $guest->room_id)
                ->update(['occupancy_status' => 'Available']);

            // Update the seats' status to Available
            $seatIds = json_decode($guest->seats_id, true); // Decode the seats_id JSON array

            if (is_array($seatIds) && !empty($seatIds)) {
                Seat::whereIn('id', $seatIds)
                    ->update(['status' => 'Available']);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function edit_guest(Request $request, $id)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // Fetch floors
            $Floors = Floor::where('admin_id', '=', $admin_id)->get();

            // Fetch the guest data by ID
            $guest = Guest::find($id);

            if (!$guest) {
                return redirect()->back()->with('error', 'Guest not found.');
            }

            return view('admin_panel.guest_managment.edit_guest_create', [
                'Floors' => $Floors,
                'guest' => $guest, // Pass the guest data to the view
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function update_guest(Request $request, $id)
    {
        $guest = Guest::find($id);

        if (!$guest) {
            return redirect()->back()->with('error', 'Guest not found.');
        }

        $admin_id = Auth::id();

        // Handle file upload for CNIC Picture if provided
        if ($request->hasFile('cnic_pic')) {
            $cnicPicPath = $request->file('cnic_pic')->store('cnic_pictures', 'public');
            $guest->cnic_pic = $cnicPicPath;
        }

        // Calculate total charges
        $leaseFrom = new \DateTime($request->lease_from);
        $leaseTo = new \DateTime($request->lease_to);
        $diffDays = $leaseFrom->diff($leaseTo)->days;

        // Retrieve room details
        $room = Room::find($request->room_id);
        $roomCharges = $room->room_charges;

        $totalCharges = $roomCharges * $diffDays;

        // Collect selected seat IDs from the request
        $selectedSeats = $request->input('seats', []); // This should be an array of seat IDs

        // Update guest details
        $guest->admin_id = $admin_id;
        $guest->name = $request->name;
        $guest->email = $request->email;

        // Only update the password if provided
        if ($request->password) {
            $guest->password = bcrypt($request->password);  // Encrypting the password for security
        }

        $guest->mobile = $request->mobile;
        $guest->id_type = $request->id_type;
        $guest->booking_date = $request->booking_date;
        $guest->id_number = $request->id_number;
        $guest->address = $request->address;
        $guest->floor_id = $request->floor_id;
        $guest->room_id = $request->room_id;  // Update the selected room ID
        $guest->seats_id = json_encode($selectedSeats); // Update the selected seat IDs as JSON
        $guest->room_charges = $roomCharges;  // Update the room charges
        $guest->total_charges = $totalCharges;
        $guest->lease_from = $request->lease_from;
        $guest->lease_to = $request->lease_to;
        $guest->updated_at = Carbon::now();

        // Save the updated guest record
        $guest->save();

        // Update the room and seat statuses
        $roomSeats = Seat::where('room_id', $request->room_id)->get();
        $bookedSeatsCount = $selectedSeats;

        // Update seat statuses
        foreach ($roomSeats as $seat) {
            if (in_array($seat->id, $bookedSeatsCount)) {
                // Update seat status to 'Booked'
                $seat->update(['status' => 'Booked']);
            } else {
                // Ensure remaining seats are available
                $seat->update(['status' => 'Available']);
            }
        }

        // Check if all seats in the room are booked
        $totalSeats = $roomSeats->count();
        $availableSeats = $roomSeats->where('status', 'Available')->count();

        if ($totalSeats == 0) {
            $occupancyStatus = 'Available';
        } elseif ($availableSeats == 0) {
            $occupancyStatus = 'Booked';
        } else {
            $occupancyStatus = 'Partially Booked';  // You can define this status if needed
        }

        // Update room occupancy status
        Room::where('id', $request->room_id)->update(['occupancy_status' => $occupancyStatus]);
        return redirect()->back()->with('success', 'Guest updated successfully!');
    }

    public function guest_advance_payment(Request $request)
    {
        $guest = Guest::find($request->guest_id);
        $guest->advance_amount = $request->advance_amount;
        $guest->advance_date = $request->advance_date;
        $guest->save();

        return redirect()->back()->with('success', 'Advance payment added successfully.');
    }

    public function addRecurringService(Request $request)
    {
        $request->validate([
            'guest_id' => 'required',
            'service_name' => 'required|string',
            'month' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        RecurringService::create([
            'guest_id' => $request->guest_id,
            'service_name' => $request->service_name,
            'month' => $request->month,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Recurring service added successfully.');
    }

    public function getRecurringServices(Request $request)
    {
        $guest_ID = $request->guest_id;

        // Fetch recurring services from the database for the given guest
        $services = RecurringService::where('guest_id', $guest_ID)
            ->get()
            ->map(function ($service) {
                // Format dates before sending response
                $service->formatted_date = Carbon::parse($service->created_at)->format('F Y'); // e.g., October 2024
                return $service;
            });

        // Return JSON response to the AJAX request
        return response()->json([
            'services' => $services
        ]);
    }
}
