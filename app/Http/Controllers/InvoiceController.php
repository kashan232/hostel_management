<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Invoice;
use App\Models\RecurringService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    public function create_invoice()
    {
        if (Auth::id()) {
            $admin_id = Auth::id();
            // Fetch guests with 'check-out' status and their associated services
            $guests = Guest::whereIn('status', ['Check-In', 'Check-Out'])
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

            // dd($guests);
            return view('admin_panel.invoice_managment.create_invoices', [
                'guests' => $guests,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function get_guest_details(Request $request)
    {
        $guest = Guest::with(['guestservices', 'recurringServices'])->find($request->guest_id);

        if (!$guest) {
            return response()->json(['error' => 'Guest not found'], 404);
        }


        $leaseFrom = Carbon::parse($guest->lease_from);
        $leaseTo = Carbon::parse($guest->lease_to);
        $stayDuration = $leaseTo->diffInDays($leaseFrom) + 1; 


        return response()->json([
            'lease_from' => $guest->lease_from,
            'lease_to' => $guest->lease_to,
            'services' => $guest->services, // Regular services
            'recurringServices' => $guest->recurringServices, // Recurring services
            'room_charges' => $guest->room_charges,
            'total_charges' => $guest->total_charges,
            'advance_amount' => $guest->advance_amount,
            'advance_date' => $guest->advance_date,
            'status' => $guest->status, // Additional fields for status
            'stay_duration' => $stayDuration,
        ]);
    }

    public function savePayment(Request $request) {
        $invoice = new Invoice();
        $invoice->guest_id = $request->guest_id;
        $invoice->amount_paid = $request->amount_to_pay;
        $invoice->payment_method = $request->payment_method;
        $invoice->due_amount = $request->remaining_due;
        $invoice->payment_date = now();
        $invoice->save();
    
        return redirect()->back()->with('success', 'Payment received successfully.');
    }

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


    public function generateInvoice($guest_id)
    {
        // Fetch the guest with associated services
        $guest = Guest::with('services')->findOrFail($guest_id);

        // Fetch recurring services associated with this guest
        $recurringServices = RecurringService::where('guest_id', $guest_id)->get();

        // Format the month to 'Month YYYY' (e.g., 'October 2024')
        foreach ($recurringServices as $recurringService) {
            $recurringService->formatted_month = Carbon::parse($recurringService->month)->format('F Y');
        }

        // Calculate the stay duration
        $leaseFrom = Carbon::parse($guest->lease_from);
        $leaseTo = Carbon::parse($guest->lease_to);
        $stayDuration = $leaseFrom->diffInDays($leaseTo);

        // Calculate total service charges
        $totalServiceCharges = $guest->services->sum('amount');

        // Calculate total room charges based on stay duration
        $totalRoomCharges = $guest->room_charges * $stayDuration;

        // Calculate total recurring service charges
        $totalRecurringCharges = $recurringServices->sum('amount');

        // Calculate total charges including room, regular services, and recurring services
        $totalCharges = $totalRoomCharges + $totalServiceCharges + $totalRecurringCharges;

        return view('admin_panel.invoice_managment.invoice_detail', [
            'guest' => $guest,
            'stayDuration' => $stayDuration,
            'totalRoomCharges' => $totalRoomCharges,
            'totalServiceCharges' => $totalServiceCharges,
            'totalRecurringCharges' => $totalRecurringCharges, // Pass recurring charges
            'totalCharges' => $totalCharges,
            'recurringServices' => $recurringServices // Pass recurring services to the view
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

        // return redirect()->back()->with('success', 'Payment has been recorded and guest status updated.');
        return redirect()->route('guest-invoice')->with('success', 'Payment has been recorded and guest status updated.');
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
        // dd($paidInvoices);
        return view('admin_panel.invoice_managment.guest_invoice', [
            'paidInvoices' => $paidInvoices,
        ]);
    }
}
