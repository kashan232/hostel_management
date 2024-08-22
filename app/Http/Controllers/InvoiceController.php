<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function guest_invoice()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // Fetch guests with 'check-out' status and their associated services
            $guests = Guest::where('status', 'check-out')
                ->with('services')
                ->get();

            // Calculate total charges for each guest
            foreach ($guests as $guest) {
                // Convert string dates to Carbon instances
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

            return view('admin_panel.invoice_managment.invoices', [
                'guests' => $guests,
            ]);
        } else {
            return redirect()->back();
        }
    }


    // InvoiceController.php
    public function generateInvoice($guest_id)
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

        return view('admin_panel.invoice_managment.invoice_detail', [
            'guest' => $guest,
            'stayDuration' => $stayDuration,
            'totalRoomCharges' => $totalRoomCharges,
            'totalServiceCharges' => $totalServiceCharges,
            'totalCharges' => $totalCharges
        ]);
    }
}
