<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestDashboardController extends Controller
{

    public function invoice_of_guests()
{
    if (Auth::check()) {
        $admin_id = Auth::id();
        $guest_id = Auth::user()->staff_id;

        // Retrieve the guest data
        $guest = Guest::where('id', $guest_id)
            ->with('services') // Ensure the relationship is loaded
            ->first();

        if ($guest) {
            // Convert string dates to Carbon instances
            $leaseFrom = Carbon::parse($guest->lease_from);
            $leaseTo = Carbon::parse($guest->lease_to);

            // Calculate the number of days for lease
            $days = $leaseFrom->diffInDays($leaseTo);

            // Calculate total service charges
            $totalServiceCharges = $guest->services->sum('amount');

            // Calculate total charges
            $guest->total_service_charges = $totalServiceCharges;
            $guest->total_charges = ($guest->room_charges * $days) + $totalServiceCharges;

            // Add Carbon instances to the guest object
            $guest->lease_from = $leaseFrom;
            $guest->lease_to = $leaseTo;

            return view('guest_panel.invoices.guest_invoices', [
                'guest' => $guest,
            ]);
        } else {
            return redirect()->back()->with('error', 'No guest data found.');
        }
    } else {
        return redirect()->route('login');
    }
}
}
