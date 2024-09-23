<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function expense_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.expense_management.expense_create', []);
        } else {
            return redirect()->back();
        }
    }

    public function store_expense(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the Service record
            $Expense = Expense::create([
                'admin_id' => $admin_id,
                'name' => $request->name, // Ensure this is a string type in the database
                'year' => $request->year, // Ensure this is a string type in the database
                'month' => $request->month, // Ensure this is a string type in the database
                'Amount' => $request->Amount, // Ensure this is a string type in the database
                'description' => $request->description, // Ensure this is a string type in the database
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('expense-added', 'Expense Add Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function expense()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Expenses = Expense::where('admin_id', '=', $admin_id)->get();
            // dd($services);
            return view('admin_panel.expense_management.expense', [
                'Expenses' => $Expenses,
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function update(Request $request)
    {
        // Add validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|numeric',
            'month' => 'required|string|max:255',
            'Amount' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        try {
            // Perform the update logic
            $expense = Expense::findOrFail($request->expense_id);
            $expense->update($validated);

            return response()->json(['success' => true, 'message' => 'Expense updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete_expense($id)
    {
        $Expense = Expense::find($id)->delete();
        return redirect()->back()->with('delete-success', 'Expense is deleted successsfully');
    }

}
