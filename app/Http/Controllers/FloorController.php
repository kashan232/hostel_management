<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    public function floor_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.floor_managment.floor_create', [
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store_floor(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the Service record
            $Floors = Floor::create([
                'admin_id' => $admin_id,
                'floor_name' => $request->floor_name, // Ensure this is a string type in the database
                'floor_number' => $request->floor_number,
                'number_of_rooms' => $request->number_of_rooms,
                'floor_type' => $request->floor_type,
                'total_area_sq_ft' => $request->total_area_sq_ft,
                'floor_description' => $request->floor_description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('Floor-added', 'Floor Is Created Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function floors()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $floors = Floor::where('admin_id', '=', $admin_id)->get();
            // dd($floors);
            return view('admin_panel.floor_managment.floors', [
                'floors' => $floors,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
