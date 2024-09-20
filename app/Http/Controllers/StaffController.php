<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffSalary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function staff()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $staffs = Staff::where('admin_id', '=', $admin_id)->get();
            // dd($staffs);
            return view('admin_panel.staff_managment.staff', [
                'staffs' => $staffs,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store_staff(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the staff record
            $Staff = Staff::create([
                'admin_id' => $admin_id,
                'name' => $request->name, // Ensure this is a string type in the database
                'username' => $request->username,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' => bcrypt($request->password), // Make sure to hash the password
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Create a user record with the same credentials and usertype 'staff'
            $user = User::create([
                'staff_id' => $Staff->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hash the password
                'usertype' => 'staff', // Set the usertype to 'staff'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('staff-added', 'Staff Created Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function staff_salary()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $staffs = Staff::where('admin_id', '=', $admin_id)->get();
            $salaries = StaffSalary::where('admin_id', '=', $admin_id)->get();
            // dd($staffs);
            return view('admin_panel.staff_managment.staff-salary', [
                'staffs' => $staffs,
                'salaries' => $salaries,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store_staff_salary(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the staff record
            $salary = StaffSalary::create([
                'admin_id' => $admin_id,
                'staff' => $request->staff,
                'date' => $request->date,
                'year' => $request->year,
                'month' => $request->month,
                'amount' => $request->amount,
                'status' => $request->status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('staff-added', 'Staff Salary Created Successfully');
        } else {
            return redirect()->back();
        }
    }


    public function staff_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['success' => false, 'message' => 'Staff not found']);
        }

        // Update staff details
        $staff->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
        ]);

        return response()->json(['success' => true, 'message' => 'Staff updated successfully']);
    }

    public function delete_staff($id)
    {
        $Staff = Staff::find($id)->delete();
        return redirect()->back()->with('delete-success', 'Staff deleted successsfully');
    }

    public function update_staff_salary(Request $request)
    {
        $salary = StaffSalary::find($request->id);

        $salary->staff = $request->staff;
        $salary->date = $request->date;
        $salary->year = $request->year;
        $salary->month = $request->month;
        $salary->amount = $request->amount;
        $salary->status = $request->status;

        $salary->save();

        return response()->json(['success' => true]);
    }

    public function delete_staff_salary($id)
    {
        $StaffSalary = StaffSalary::find($id)->delete();
        return redirect()->back()->with('delete-success', 'Staff Salary deleted successsfully');
    }
}
