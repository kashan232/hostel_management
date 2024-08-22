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

            // Retrieve the guest data with relationships
            $guest = Guest::where('id', $guest_id)
                ->with('services') // Ensure the relationship is loaded
                ->first();

            if ($guest) {
                // Check if lease_from and lease_to are present
                $leaseFrom = $guest->lease_from ? Carbon::parse($guest->lease_from) : null;
                $leaseTo = $guest->lease_to ? Carbon::parse($guest->lease_to) : null;

                // Calculate the number of days for lease
                $days = $leaseFrom && $leaseTo ? $leaseFrom->diffInDays($leaseTo) : 0;

                // Calculate total service charges
                $totalServiceCharges = $guest->services ? $guest->services->sum('amount') : 0;

                // Calculate total charges
                $guest->total_service_charges = $totalServiceCharges;
                $guest->total_charges = ($guest->room_charges * $days) + $totalServiceCharges;

                // Add Carbon instances to the guest object
                $guest->lease_from = $leaseFrom;
                $guest->lease_to = $leaseTo;

                return view('guest_panel.invoices.guest_invoices', [
                    'guest' => $guest, // Pass a single guest object
                ]);
            } else {
                return redirect()->back()->with('error', 'No guest data found.');
            }
        } else {
            return redirect()->route('login');
        }
    }


    // InvoiceController.php
    public function view_invoice($guest_id)
    {
        $guest = Guest::with('services')->findOrFail($guest_id);
        // dd($guest);
        // Calculate the stay duration
        $leaseFrom = Carbon::parse($guest->lease_from);
        $leaseTo = Carbon::parse($guest->lease_to);
        $stayDuration = $leaseFrom->diffInDays($leaseTo);

        // Calculate total service charges
        $totalServiceCharges = $guest->services->sum('amount');

        // Calculate total room charges based on stay duration
        $totalRoomCharges = $guest->room_charges * $stayDuration;

        // Calculate total charges including room and services
        $totalCharges = $totalRoomCharges + $totalServiceCharges;

        return view('guest_panel.invoices.invoice_detail', [
            'guest' => $guest,
            'stayDuration' => $stayDuration,
            'totalRoomCharges' => $totalRoomCharges,
            'totalServiceCharges' => $totalServiceCharges,
            'totalCharges' => $totalCharges
        ]);
    }
}
