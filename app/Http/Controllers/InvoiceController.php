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
            // dd($userId);
            $guests = Guest::where('status', 'check-out')->with('services')->get();

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
