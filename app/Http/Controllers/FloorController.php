<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    public function floor_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.floor_managment.floor_create', [
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function floors()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.floor_managment.floors', [
            ]);
        } else {
            return redirect()->back();
        }
    }
}
