<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function inventory_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.inventory_management.inventory_create', []);
        } else {
            return redirect()->back();
        }
    }

    public function store_inventory(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the Service record
            $Expense = Inventory::create([
                'admin_id' => $admin_id,
                'name' => $request->name, // Ensure this is a string type in the database
                'price' => $request->price, // Ensure this is a string type in the database
                'qunty' => $request->qunty, // Ensure this is a string type in the database
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('inventory-added', 'Inventory Add Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function inventory()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Inventories = Inventory::where('admin_id', '=', $admin_id)->get();
            // dd($services);
            return view('admin_panel.inventory_management.inventory', [
                'Inventories' => $Inventories,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qunty' => 'required|integer'
        ]);

        $inventory = Inventory::findOrFail($request->id);

        $inventory->name = $validatedData['name'];
        $inventory->price = $validatedData['price'];
        $inventory->qunty = $validatedData['qunty'];

        $inventory->save();

        return response()->json(['success' => true, 'message' => 'Inventory updated successfully']);
    }

    public function delete_inventory($id)
    {
        $Inventory = Inventory::find($id)->delete();
        return redirect()->back()->with('delete-success', 'Inventory is deleted successsfully');
    }

}
