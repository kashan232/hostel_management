@include('guest_panel.inlcude.header_include')

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

<div id="main-wrapper" class="wallet-open active">
    @include('guest_panel.inlcude.top_sidebar_include')
    @include('guest_panel.inlcude.navbar_include')
    @include('guest_panel.inlcude.sidebar_include')

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

                                <!-- Charges Breakdown -->
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
                                                <tr>
                                                    <td>Room Charges ({{ $stayDuration }} days)</td>
                                                    <td class="text-right">{{ number_format($guest->room_charges * $stayDuration, 2) }}</td>
                                                </tr>
                                                @foreach($guest->services as $service)
                                                <tr>
                                                    <td>Service: {{ $service->service_name }}</td>
                                                    <td class="text-right">{{ number_format($service->amount, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr class="font-weight-bold">
                                                    <td>Total Charges</td>
                                                    <td class="text-right">{{ number_format($totalCharges, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text-center mt-3"><strong>Total Amount Due:</strong> <span class="display-4">{{ number_format($totalCharges, 2) }}</span></p>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="row mt-5 text-center">
                                    <div class="col-md-12">
                                        <p class="mb-0">Thank you for staying with us!</p>
                                        <p>If you have any questions, please contact us at {{ config('app.contact_email') }}.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('guest_panel.inlcude.copyright_include')
</div>

@include('guest_panel.inlcude.footer_include')