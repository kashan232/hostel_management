<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Invoice;
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

    public function store_payment(Request $request, $guestId)
    {
        // Retrieve the guest record
        $guest = Guest::findOrFail($guestId);

        // Retrieve the payment amount from the request
        $amountPaid = $request->input('amount_paid');

        // Calculate the new due amount
        $currentDueAmount = $guest->total_charges - $guest->paid_amount; // Assuming you have a paid_amount column to track total paid so far
        $newDueAmount = max(0, $currentDueAmount - $amountPaid); // Ensure due amount is not negative

        // Store payment details in the Invoice table
        Invoice::create([
            'guest_id' => $guest->id, // Store the guest ID in the invoice
            'amount_paid' => $amountPaid, // Amount paid by the guest
            'payment_method' => $request->input('payment_method'), // Payment method used
            'due_amount' => $newDueAmount, // Calculated due amount
            'payment_date' => now(), // Store the current date as payment date
        ]);

        // Update the guest's status based on the new due amount
        $guest->update([
            'status' => $newDueAmount > 0 ? 'Partially Paid' : 'Paid', // Update status based on due amount
        ]);

        return redirect()->back()->with('success', 'Payment has been recorded and guest status updated.');
    }



    public function showPaidInvoices()
    {
        $paidInvoices = Invoice::with(['guest', 'guest.servicesinvoice']) // Assuming 'services' is the relationship in the Guest model
            ->where('due_amount', 0)
            ->get();
        // dd($paidInvoices);
        foreach ($paidInvoices as $invoice) {
            // Calculate total service charges for the guest
            $totalServiceCharges = $invoice->guest->services->sum('amount');
            $invoice->total_service_charges = $totalServiceCharges;
            $invoice->total_payable = $invoice->guest->total_charges + $totalServiceCharges;
        }

        return view('admin_panel.invoice_managment.guest_invoice', [
            'paidInvoices' => $paidInvoices,
        ]);
    }
}
