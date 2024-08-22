<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\ComplainRemark;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
            } else if ($usertype == 'Guest') {

                return view('guest_panel.guest_dashboard');
            }
        } else {
            // return redirect()->back();
            return redirect()->route('login');
        }
    }


    public function admin_complains()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            $Complains = Complain::all();
            // dd($services);
            return view('admin_panel.complain_managment.complains', [
                'Complains' => $Complains,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function view_admin_complains($id)
    {
        $complain = Complain::findOrFail($id);

        // Retrieve the related complaint remarks
        $complaint_remarks = ComplainRemark::where('complain_id', $complain->id)->get();

        return view('admin_panel.complain_managment.view_complains', [
            'complain' => $complain,
            'complaint_remarks' => $complaint_remarks,
        ]);
    }

    public function action_on_complaint(Request $request)
    {
        if (Auth::id()) {
            $complain_id = $request->input('complain_id');
            $complainRemark = ComplainRemark::create([
                'complain_id' => $request->input('complain_id'),
                'remark' => $request->input('remark'),
                'status' => $request->input('status'), // Corrected this line to use 'status'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        
            Complain::where('id', $complain_id)->update([
                'status' => $request->input('status'),
                'updated_at' => Carbon::now()
            ]);
        
            if ($complainRemark) {
                return response()->json(['message' => 'Complaint remark saved successfully']);
            } else {
                return response()->json(['error' => 'Failed to save complaint remark'], 500);
            }
        } else {
            // User is not authenticated, return 401 unauthorized
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        

    }

}
