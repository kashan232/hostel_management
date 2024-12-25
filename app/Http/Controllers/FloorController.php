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
            return view('admin_panel.floor_managment.floor_create', []);
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

    public function floors_update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'floor_name' => 'required|string|max:255',
            'floor_number' => 'required|integer|min:1',
            'number_of_rooms' => 'required|integer|min:1',
            'floor_type' => 'required|string',
            'total_area_sq_ft' => 'required|numeric|min:1',
            'floor_description' => 'nullable|string',
        ]);

        // Find the floor by ID and update it
        $floor = Floor::findOrFail($id);
        $floor->floor_name = $request->floor_name;
        $floor->floor_number = $request->floor_number;
        $floor->number_of_rooms = $request->number_of_rooms;
        $floor->floor_type = $request->floor_type;
        $floor->total_area_sq_ft = $request->total_area_sq_ft;
        $floor->floor_description = $request->floor_description;
        $floor->save();

        // Return response
        return response()->json(['success' => 'Floor updated successfully!']);
    }

    public function delete_floors($id)
    {
        $Floor = Floor::find($id);
    
        if ($Floor) {  // Check if the record exists
            $Floor->delete();  // Delete the record
            return redirect()->back()->with('delete-success', 'Floor deleted successfully');
        } else {
            return redirect()->back()->with('delete-error', 'Floor not found');
        }
    }
    

}
