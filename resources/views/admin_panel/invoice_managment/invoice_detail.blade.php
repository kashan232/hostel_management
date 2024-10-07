@include('admin_panel.inlcude.header_include')

<style>
    @media print {

        /* Hide unnecessary elements */
        .dlabnav,
        .nav-header,
        .header,
        .sidebar,
        .copyright,
        .btn-primary,
        .print-btn,
        .back-btn {
            display: none;
        }

        .content-body {
            margin: 0;
            padding: 10px;
        }

        .invoice-content {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }

        .invoice-logo img {
            max-width: 100px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .display-4 {
            font-size: 1.5rem;
            font-weight: bold;
        }
    }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('store-payment', $guest->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" value="{{ number_format($totalCharges, 2) }}" readonly>
                    </div>
                    <!-- Advance Payment -->
                    @if($guest->advance_amount)
                    <div class="form-group">
                        <label for="advance_payment" class="text-danger">Advance Payment Received</label>
                        <input type="text" class="form-control" id="advance_payment" value="-{{ number_format($guest->advance_amount, 2) }}" readonly>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="total_amount">Total Amount Due</label>
                        <input type="text" class="form-control" id="total_amount_due" value=" {{ number_format(($totalCharges - ($guest->advance_amount ?? 0)), 2) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount_paid">Amount to Pay</label>
                        <input type="number" class="form-control" name="amount_paid" id="amount_paid" placeholder="Enter amount" required>
                    </div>
                    <div class="form-group">
                        <label for="remaining_due">Remaining Due Amount</label>
                        <input type="text" class="form-control" id="remaining_due" readonly>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="cash">Cash</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="main-wrapper" class="wallet-open active">
    @include('admin_panel.inlcude.top_sidebar_include')
    @include('admin_panel.inlcude.navbar_include')
    @include('admin_panel.inlcude.sidebar_include')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="invoice-content">
                                <!-- Header -->
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <div class="invoice-logo mb-3">
                                            <img src="https://img.icons8.com/ios-filled/100/000000/receipt-dollar.png" alt="Invoice Logo" style="max-width: 100px;">
                                        </div>
                                        <h2 class="mb-2">Invoice</h2>
                                    </div>
                                </div>

                                <!-- Invoice Details -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Guest Name:</strong> {{ $guest->name }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $guest->email }}</p>
                                        <p class="mb-1"><strong>Mobile:</strong> {{ $guest->mobile }}</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p class="mb-1"><strong>Invoice Date:</strong> {{ now()->format('d M Y') }}</p>
                                        <p class="mb-1"><strong>Booking Date:</strong> {{ $guest->booking_date }}</p>
                                    </div>
                                </div>

                                <!-- Booking Details -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3">Booking Details</h5>
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Floor:</strong></td>
                                                    <td>{{ $guest->floor->floor_name }}</td>
                                                    <td><strong>Room:</strong></td>
                                                    <td>{{ $guest->room->room_number }}</td>
                                                    <td><strong>Seat:</strong></td>
                                                    <td>
                                                        @if($guest->seats->isNotEmpty())
                                                        @foreach($guest->seats as $seat)
                                                        {{ $seat->seat_name }}@if (!$loop->last), @endif
                                                        @endforeach
                                                        @else
                                                        No seats assigned
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Lease From:</strong></td>
                                                    <td>{{ $guest->lease_from }}</td>
                                                    <td><strong>Lease To:</strong></td>
                                                    <td>{{ $guest->lease_to }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Stay Duration:</strong></td>
                                                    <td>{{ $stayDuration }} days</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3">Charges Breakdown</h5>
                                        <table class="table table-sm table-bordered mb-4">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Description</th>
                                                    <th class="text-right">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Room Charges -->
                                                <tr>
                                                    <td>Room Charges ({{ $stayDuration }} days)</td>
                                                    <td class="text-right">{{ number_format($totalRoomCharges, 2) }}</td>
                                                </tr>

                                                <!-- Regular Services -->
                                                @foreach($guest->services as $service)
                                                <tr>
                                                    <td>Service: {{ $service->service_name }}</td>
                                                    <td class="text-right">{{ number_format($service->amount, 2) }}</td>
                                                </tr>
                                                @endforeach

                                                <!-- Recurring Services -->
                                                @foreach($recurringServices as $recurringService)
                                                <tr>
                                                    <td>Recurring Service ({{ $recurringService->formatted_month }}): {{ $recurringService->service_name }}</td>
                                                    <td class="text-right">{{ number_format($recurringService->amount, 2) }}</td>
                                                </tr>
                                                @endforeach

                                                <!-- Total Charges -->
                                                <tr class="font-weight-bold">
                                                    <td>Total Charges</td>
                                                    <td class="text-right">{{ number_format($totalCharges, 2) }}</td>
                                                </tr>

                                                <!-- Advance Payment (if any) -->
                                                @if($guest->advance_amount)
                                                <tr>
                                                    <td>Advance Payment Received on {{ $guest->advance_date }}</td>
                                                    <td class="text-right text-danger">-{{ number_format($guest->advance_amount, 2) }}</td>
                                                </tr>
                                                @endif

                                                <!-- Amount Due -->
                                                <tr class="font-weight-bold">
                                                    <td>Amount Due</td>
                                                    <td class="text-right">
                                                        {{ number_format(($totalCharges - ($guest->advance_amount ?? 0)), 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Total Amount Due -->
                                        <p class="text-center mt-3"><strong>Total Amount Due:</strong>
                                            <span class="display-4">{{ number_format(($totalCharges - ($guest->advance_amount ?? 0)), 2) }}</span>
                                        </p>
                                    </div>
                                </div>



                                <!-- Footer -->
                                <div class="row mt-5 text-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Thank you for staying with us!</p>
                                        <p>If you have any questions, please contact us at {{ config('app.contact_email') }}.</p>
                                    </div>
                                </div>

                                <!-- Payment Button -->
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-plus"></i>
                                        Make Payment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin_panel.inlcude.copyright_include')
</div>

@include('admin_panel.inlcude.footer_include')

<script>
    $(document).ready(function() {
        // When the modal is shown
        $('#paymentModal').on('shown.bs.modal', function() {
            // Set the initial remaining due amount based on the total amount
            var totalAmount = parseFloat($('#total_amount_due').val().replace(/,/g, '')); // Removing commas for accurate calculations
            $('#remaining_due').val(totalAmount.toFixed(2));
        });

        // Update the remaining due amount when the amount to pay is changed
        $('#amount_paid').on('input', function() {
            var totalAmount = parseFloat($('#total_amount_due').val().replace(/,/g, '')); // Removing commas for accurate calculations
            var amountPaid = parseFloat($(this).val()) || 0; // Default to 0 if input is empty or invalid

            var remainingDue = totalAmount - amountPaid;
            $('#remaining_due').val(remainingDue.toFixed(2));
        });
    });
</script>