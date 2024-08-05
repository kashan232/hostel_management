<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function staff()
    {
        return view('admin_panel.staff_managment.staff');
    }
    public function staff_salary()
    {
        return view('admin_panel.staff_managment.staff-salary');
    }
}
