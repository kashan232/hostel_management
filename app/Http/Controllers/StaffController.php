<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function staff()
    {
        return view('admin_panel.staff_managment.staff');
    }

    public function store_staff(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            $userId = Auth::id();
            User::create([
                'admin_or_user_id'    => $userId,
                'name'          => $request->name,
                'username'          => $request->username,
                'email'          => $request->email,
                'usertype'          => $request->usertype,
                'password'          => Hash::make($request->input('password')), // Hash the password
                'category'          => $request->category,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
            return redirect()->back()->with('Category-added', 'Category Added Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function staff_salary()
    {
        return view('admin_panel.staff_managment.staff-salary');
    }
}
