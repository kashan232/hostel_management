<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    
    public function notices_create()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            return view('admin_panel.notices_managment.notice_create', []);
        } else {
            return redirect()->back();
        }
    }

    public function store_notices(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth::id();

            // Create the Service record
            $Notice = Notice::create([
                'admin_id' => $admin_id,
                'title' => $request->title,
                'notice_date' => $request->notice_date,
                'expiry_date' => $request->expiry_date,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('notice-added', 'Notice created Successfully');
        } else {
            return redirect()->back();
        }
    }

    public function notices()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Notices = Notice::where('admin_id', '=', $admin_id)->get();
            // dd($services);
            return view('admin_panel.notices_managment.notices', [
                'Notices' => $Notices,
            ]);
        } else {
            return redirect()->back();
        }
    }

}
