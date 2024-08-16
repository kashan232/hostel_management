@include('admin_panel.inlcude.header_include')

<div id="main-wrapper" class="wallet-open active">
    @include('admin_panel.inlcude.top_sidebar_include')
    @include('admin_panel.inlcude.navbar_include')
    @include('admin_panel.inlcude.sidebar_include')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Invoice for {{ $guest->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="invoice-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Guest Details</h5>
                                        <p>Name: {{ $guest->name }}</p>
                                        <p>Email: {{ $guest->email }}</p>
                                        <p>Mobile: {{ $guest->mobile }}</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5>Invoice Date: {{ now()->format('d M Y') }}</h5>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Booking Details</h5>
                                        <p>Booking Date: {{ $guest->booking_date }}</p>
                                        <p>Floor: {{ $guest->floor->floor_name }}</p>
                                        <p>Room: {{ $guest->room->room_number }}</p>
                                        <p>Lease From: {{ $guest->lease_from }}</p>
                                        <p>Lease To: {{ $guest->lease_to }}</p>
                                        <p>Stay Duration: {{ $stayDuration }} days</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Charges</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Room Charges ({{ $stayDuration }} days)</td>
                                                    <td>{{ $guest->room_charges * $stayDuration }}</td>
                                                </tr>
                                                @foreach($guest->services as $service)
                                                <tr>
                                                    <td>Service: {{ $service->service_name }}</td>
                                                    <td>{{ $service->amount }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td><strong>Total Charges</strong></td>
                                                    <td><strong>{{ $totalCharges }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
