<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function home()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('user_panel.user_dashboard');
            } else if ($usertype == 'admin') {
                return view('admin_panel.admin_dashboard');
            }
        } else {
            // return redirect()->back();
            return redirect()->route('login');
        }
    }
}
