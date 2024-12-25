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

    public function update(Request $request)
    {
        $notice = Notice::find($request->id);

        if ($notice) {
            $notice->title = $request->title;
            $notice->notice_date = $request->notice_date;
            $notice->expiry_date = $request->expiry_date;
            $notice->description = $request->description;
            $notice->save();

            return response()->json(['success' => true, 'message' => 'Notice updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Notice not found!']);
    }

    public function delete_notices($id)
    {
        $notice = Notice::find($id);
    
        if ($notice) {
            $notice->delete();
            return redirect()->back()->with('delete-success', 'Notice is deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Notice not found');
        }
    }

}
