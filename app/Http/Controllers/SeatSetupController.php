<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Room;
use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatSetupController extends Controller
{
    public function seat_setup_create()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $floors = Floor::where('admin_id', '=', $admin_id)->get();
            // dd($floors);
            return view('admin_panel.seat_managment.seats_create', [
                'floors' => $floors,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store_seat_setup(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $request->validate([
                'floor_id' => 'required|exists:floors,id',
                'room_id' => 'required|exists:rooms,id',
                'seat_name' => 'required|string|max:255',
                'status' => 'required|string|in:Available,Booked',
            ]);
            $Seats = Seat::create([
                'admin_id' => $admin_id,
                'floor_id' => $request->floor_id, // Ensure this is a string type in the database
                'room_id' => $request->room_id,
                'seat_name' => $request->seat_name,
                'status' => $request->status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('seat-added', 'Seat has been added successfully');
        } else {
            return redirect()->back();
        }
    }

    public function seat_setup()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // $Seats = Seat::where('admin_id', '=', $admin_id)->get();
            // dd($Seats);
            // Eager load the floor and room relationships
            $Seats = Seat::with(['floor', 'room'])->get();
            $floors = Floor::where('admin_id', '=', $admin_id)->get();
            // dd($floors);


            return view('admin_panel.seat_managment.seats', [
                'Seats' => $Seats,
                'floors' => $floors,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function getRooms($floorId)
    {
        $rooms = Room::where('floor_id', $floorId)->get();
        return response()->json(['rooms' => $rooms]);
    }

    public function updateSeat(Request $request)
    {
        $seat = Seat::find($request->input('seat_id'));

        if ($seat) {
            $seat->floor_id = $request->input('floor_id');
            $seat->room_id = $request->input('room_id');
            $seat->seat_name = $request->input('seat_name');
            $seat->status = $request->input('status');
            $seat->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Seat not found']);
    }

    public function delete_seat($id)
    {
        $Seat = Seat::find($id)->delete();
        return redirect()->back()->with('delete-success', 'Seat is deleted successsfully');
    }
}
