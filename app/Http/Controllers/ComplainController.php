<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplainController extends Controller
{


    public function complain_form()
    {
        if (Auth::check()) {
            $admin_id = Auth::id();
            $guest_id = Auth::user()->staff_id;

            return view('guest_panel.complain_managment.complains_create', []);
        } else {
            return redirect()->route('login');
        }
    }

    public function store_complain(Request $request)
    {
        if (Auth::id()) {
            $admin_id = Auth()->user()->staff_id;
            // Handle the file upload
            $imageName = null;
            if ($request->hasFile('complaint_pic')) {
                $image = $request->file('complaint_pic');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('complain_images'), $imageName);
            }

            // Create the Complain record
            $complain = Complain::create([
                'admin_id' => $admin_id,
                'complaint_title' => $request->complaint_title,
                'complaint_date' => $request->complaint_date,
                'complaint_type' => $request->complaint_type,
                'complaint_pic' => $imageName, // Save the image name in the database
                'complaint_description' => $request->complaint_description,
                'status' => 'Un-Resolved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('complain-added', 'Complaint Added Successfully');
        } else {
            return redirect()->back();
        }
    }


    public function complains()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Complains = Complain::where('admin_id', '=', $admin_id)->get();
            // dd($services);
            return view('guest_panel.complain_managment.complains', [
                'Complains' => $Complains,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
