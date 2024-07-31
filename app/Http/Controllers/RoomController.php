<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function room_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.room_managment.room_create', [
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function rooms()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.room_managment.rooms', [
            ]);
        } else {
            return redirect()->back();
        }
    }
}
