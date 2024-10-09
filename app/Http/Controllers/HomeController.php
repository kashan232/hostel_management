<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\ComplainRemark;
use App\Models\Floor;
use App\Models\Guest;
use App\Models\GuestService;
use App\Models\Notice;
use App\Models\RecurringService;
use App\Models\Room;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


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

                $userId = Auth()->user()->staff_id;


                // Assuming you use Laravel's authentication system
                // Count the complaints where the logged-in user's ID matches the 'admin_id'

                $admin_id = Auth::id();

                // Fetch all guests created by this admin
                $guests = Guest::where('admin_id', $admin_id)->pluck('id'); // admin ke guests ke ids
                // dd($guests);
                // Fetch complaints of only the guests created by this admin
                $complaintCount = Complain::whereIn('guest_id', $guests)->count();
                
                // $complaintCount = Complain::where('admin_id', $userId)->count();

                // Get the total amount and count for guest services
                $guestServices = GuestService::where('guest_id', $userId)->get();
                $guestServicesTotal = $guestServices->sum('amount');
                $guestServicesCount = $guestServices->count();

                // Get the total amount and count for recurring services
                $recurringServices = RecurringService::where('guest_id', $userId)->get();
                $recurringServicesTotal = $recurringServices->sum('amount');
                $recurringServicesCount = $recurringServices->count();
                $noticeCount = Notice::count();

                // Pass the data to the view
                return view('guest_panel.guest_dashboard', compact(
                    'complaintCount',
                    'noticeCount',
                    'guestServices',
                    'guestServicesCount',
                    'recurringServicesCount',
                    'guestServicesTotal',
                    'recurringServices',
                    'recurringServicesTotal'
                ));
                // Pass the count to the view
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

            // Fetch all guests created by this admin
            $guests = Guest::where('admin_id', $admin_id)->pluck('id'); // admin ke guests ke ids
            // dd($guests);
            // Fetch complaints of only the guests created by this admin
            $Complains = Complain::whereIn('guest_id', $guests)->get();
            // dd($Complains);
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

    public function Admin_Change_Password()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);

            // $all_department = Department::where('admin_or_user_id', '=', $userId)->get();
            return view('admin_panel.admin_change_password', [
                // 'all_department' => $all_department,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function Admin_profile_page()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            $profile = User::where('id', $userId)->first();

            // $all_department = Department::where('admin_or_user_id', '=', $userId)->get();
            return view('admin_panel.admin_profile', [
                'profile' => $profile,
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function updte_change_Password(Request $request)
    {
        if (Auth::id()) {
            // Validate the form data
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'retype_new_password' => 'required|same:new_password'
            ]);

            // Get the current authenticated user
            $user = Auth::user();

            // Check if the old password matches
            if (!Hash::check($request->input('old_password'), $user->password)) {
                return redirect()->back()->with('error', 'Old password is incorrect');
            }

            // Check if the user is an admin
            if ($user->usertype !== 'admin') {
                return redirect()->back()->with('error', 'Unauthorized action');
            }

            // Update the password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            // Add a success message to the session
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::id(); // Get the current user's ID

        // Validate the incoming request data
        $request->validate([
            'hostel_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|max:255',
            'owner_cnic' => 'required|string|max:255',
            'owner_address' => 'required|string|max:255',
            'owner_city' => 'required|string|max:255',
        ]);

        // Save or update the user's profile
        User::updateOrCreate(
            ['id' => $userId],
            [
                'hostel_name' => $request->input('hostel_name'),
                'owner_name' => $request->input('owner_name'),
                'owner_email' => $request->input('owner_email'),
                'owner_cnic' => $request->input('owner_cnic'),
                'owner_address' => $request->input('owner_address'),
                'owner_city' => $request->input('owner_city'),
            ]
        );

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function guest_Change_Password()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            // $all_department = Department::where('admin_or_user_id', '=', $userId)->get();
            return view('guest_panel.guest_change_password', [
                // 'all_department' => $all_department,
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function guest_updte_change_Password(Request $request)
    {
        if (Auth::id()) {
            // dd($request)
            // Validate the request data
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'retype_new_password' => 'required|same:new_password'
            ]);

            // Get the currently authenticated user
            $user = Auth::user();
            // dd($user);
            // Check if the old password matches the current password
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'The provided old password does not match our records');
            }

            // Update password in the users table
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Update password in the hr table
            $guest = Guest::where('id', $user->staff_id)->first();
            if ($guest) {
                $guest->password = $request->new_password;  // No hashing for the hr table password
                $guest->save();
            } else {
                return back()->with('error', '');
                return redirect()->back()->with('error', 'Guest record not found.');
            }
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back();
        }
    }
}
