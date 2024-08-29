<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\ComplainRemark;
use App\Models\Floor;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function home()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {

                return view('user_panel.user_dashboard');
            } else if ($usertype == 'admin') {


                $admin_id = Auth::id();

                // Fetch the relevant data based on admin_id
                $totalStaff = Staff::where('admin_id', $admin_id)->count();
                $totalServices = Service::where('admin_id', $admin_id)->count();
                $Floor = Floor::where('admin_id', $admin_id)->count();
                $rooms = Room::where('admin_id', $admin_id)->count();

                // Total complaints count
                $totalComplaints = DB::table('complains')->count();

                // Unresolved complaints count (assuming unresolved status is anything other than 'Closed')
                $unresolvedComplaints = DB::table('complains')
                    ->where('status',  'Un-Resolved')
                    ->count();


                // Resolved complaints count (assuming resolved status is 'Closed')
                $InprogressComplaints = DB::table('complains')
                    ->where('status', 'In-Process')
                    ->count();

                // Resolved complaints count (assuming resolved status is 'Closed')
                $resolvedComplaints = DB::table('complains')
                    ->where('status', 'Resolved')
                    ->count();

                // Sum of all invoice payments
                $totalInvoices = DB::table('invoices')->sum('amount_paid');

                // Sum of all expenses
                $totalExpenses = DB::table('expenses')->sum('amount');

                // Total complaints count
                $totalComplaints = DB::table('complains')->count();

                // Unresolved complaints count (assuming unresolved status is anything other than 'Closed')
                $unresolvedComplaints = DB::table('complains')
                    ->where('status',  'Un-Resolved')
                    ->count();


                // Resolved complaints count (assuming resolved status is 'Closed')
                $InprogressComplaints = DB::table('complains')
                    ->where('status', 'In-Process')
                    ->count();

                // Total complaints count
                $totalinvoicesgust = DB::table('guests')->count();

                // Unresolved complaints count (assuming unresolved status is anything other than 'Closed')
                $paidinvoice = DB::table('guests')
                    ->where('status',  'Paid')
                    ->count();


                // Resolved complaints count (assuming resolved status is 'Closed')
                $unpaidinvoices = DB::table('guests')
                    ->where('status', 'Check-In')
                    ->count();

                $Rooms = Room::where('admin_id', '=', $admin_id)->get();

                $guests = Guest::where('admin_id', $admin_id)
                    ->with(['floor', 'room', 'services'])
                    ->get();

                // Compute total service charges and update guests' total charges
                foreach ($guests as $guest) {
                    // Convert string dates to Carbon instancesd
                    $leaseFrom = Carbon::parse($guest->lease_from);
                    $leaseTo = Carbon::parse($guest->lease_to);

                    // Calculate the number of days for lease
                    $days = $leaseFrom->diffInDays($leaseTo);

                    // Calculate total service charges
                    $totalServiceCharges = $guest->services->sum('amount');

                    // Calculate total charges (room charges multiplied by number of days + total service charges)
                    $guest->total_service_charges = $totalServiceCharges;
                    $guest->total_charges = ($guest->room_charges * $days) + $totalServiceCharges;
                }

                $services = Service::where('admin_id', $admin_id)->get();

                // Add more queries as per your requirement
                return view('admin_panel.admin_dashboard', compact('totalStaff', 'totalServices', 'Floor', 'rooms', 'totalComplaints', 'unresolvedComplaints', 'resolvedComplaints', 'InprogressComplaints', 'totalInvoices', 'totalExpenses', 'totalinvoicesgust', 'paidinvoice', 'unpaidinvoices', 'Rooms', 'guests'));
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
