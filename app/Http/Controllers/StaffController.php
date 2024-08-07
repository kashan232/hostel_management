<?php

namespace App\Http\Controllers;

use App\Models\Staff;
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
            // dd($staffs);
            return view('admin_panel.staff_managment.staff-salary', [
                'staffs' => $staffs,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
