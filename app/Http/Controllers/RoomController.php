<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function room_create()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $floors = Floor::where('admin_id', '=', $admin_id)->get();
            // dd($floors);
            return view('admin_panel.room_managment.room_create', [
                'floors' => $floors,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store_room(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // dd($request);
            // Create the Service record
            $Floors = Room::create([
                'admin_id' => $admin_id,
                'floor_id' => $request->floor_id, // Ensure this is a string type in the database
                'room_number' => $request->room_number,
                'room_type' => $request->room_type,
                'room_amenities' => $request->room_amenities,
                'occupancy_status' => $request->occupancy_status,
                'room_description' => $request->room_description,
                'room_charges' => $request->room_charges,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('room-added', 'Room Is Created Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function rooms()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Rooms = Room::where('admin_id', '=', $admin_id)->get();
            // dd($Rooms);

            return view('admin_panel.room_managment.rooms', [
                'Rooms' => $Rooms,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
