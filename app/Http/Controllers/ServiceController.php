<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function services_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.services_managment.service_create', [
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function services()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.services_managment.services', [
            ]);
        } else {
            return redirect()->back();
        }
    }
}
