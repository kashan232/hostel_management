<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function guest_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.guest_managment.guest_create', [
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function guests()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.guest_managment.guests', [
            ]);
        } else {
            return redirect()->back();
        }
    }
}