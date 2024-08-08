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

            // Create the Service record
            $Floors = Room::create([
                'admin_id' => $admin_id,
                'floor_name' => $request->floor_name, // Ensure this is a string type in the database
                'room_number' => $request->room_number,
                'room_type' => $request->room_type,
                'number_of_beds' => $request->number_of_beds,
                'room_size' => $request->room_size,
                'room_amenities' => $request->room_amenities,
                'occupancy_status' => $request->occupancy_status,
                'room_description' => $request->room_description,
                'daily_charge' => $request->daily_charge,
                'monthly_charge' => $request->monthly_charge,
                'yearly_charge' => $request->yearly_charge,
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
