<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Guest;
use App\Models\GuestService;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $rooms = Room::where('floor_id', $request->floor_id)->where('occupancy_status', 'Available')->get(['id', 'room_number', 'room_charges']);
        return response()->json($rooms);
    }

    public function store_guest(Request $request)
    {
        $admin_id = Auth::id();

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
            'room_charges' => $roomCharges,  // Store the room charges
            'total_charges' => $totalCharges,
            'lease_from' => $request->lease_from,
            'lease_to' => $request->lease_to,
            'status' => 'Check-In',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Update the room occupancy status
        Room::where('id', $request->room_id)
            ->where('floor_id', $request->floor_id)
            ->update(['occupancy_status' => 'Booked']);

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

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
