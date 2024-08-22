@include('guest_panel.inlcude.header_include')
<!--*******************
        Preloader end
    ********************-->
<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper" class="wallet-open active">
    <!--**********************************
            Nav header start
        ***********************************-->
    @include('guest_panel.inlcude.top_sidebar_include')

    <!--**********************************
            Nav header end
        ***********************************-->
    <!--**********************************
            Header start
        ***********************************-->
    @include('guest_panel.inlcude.navbar_include')
    <!--**********************************
            Header end
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    @include('guest_panel.inlcude.sidebar_include')
    <!--**********************************
            Sidebar end
        ***********************************-->
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Guest Invoice</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="example" class="display table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Name | Email | Mobile</th>
                                            <th>Booking Date</th>
                                            <th>Floor</th>
                                            <th>Room</th>
                                            <th>Charges per Day</th>
                                            <th>Total Charges</th>
                                            <th>Total Days</th>
                                            <th>Lease From</th>
                                            <th>Lease To</th>
                                            <th>Status</th>
                                            <th>Booking</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $guest->name }} <br> {{ $guest->email }} <br> {{ $guest->mobile }}</td>
                                            <td>{{ $guest->booking_date }}</td>
                                            <td>{{ $guest->floor ? $guest->floor->floor_name : 'N/A' }}</td>
                                            <td>{{ $guest->room ? $guest->room->room_number : 'N/A' }}</td>
                                            <td>{{ $guest->room_charges }}</td>
                                            <td>{{ $guest->total_charges }}</td>
                                            <td>{{ $guest->lease_from && $guest->lease_to ? $guest->lease_from->diffInDays($guest->lease_to) : 'N/A' }}</td>
                                            <td>{{ $guest->lease_from ? $guest->lease_from->toDateString() : 'N/A' }}</td>
                                            <td>{{ $guest->lease_to ? $guest->lease_to->toDateString() : 'N/A' }}</td>
                                            <td>
                                                @if($guest->status === 'Check-In')
                                                <span class="badge bg-success">Checked In</span>
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($guest->status === 'Check-In')
                                                <button class="btn btn-danger btn-sm end-booking-btn" data-guest-id="{{ $guest->id }}">End Booking</button>
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('view-invoice', $guest->id) }}" class="btn btn-danger btn-sm">View Invoice</a>
                                            </td>
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


<!--**********************************
            Content body end
        ***********************************-->
<!--**********************************
   Footer start
  ***********************************-->
@include('guest_panel.inlcude.copyright_include')

</div>
<!--**********************************
        Scripts
    ***********************************-->
@include('guest_panel.inlcude.footer_include')

<script>
    $(document).ready(function() {
        $('#addServiceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var guestId = button.data('guest-id');
            var modal = $(this);
            modal.find('.modal-body #guest_id').val(guestId);
        });

        $('#service_id').on('change', function() {
            var selectedService = $(this).find(':selected');
            var amount = selectedService.data('amount');
            $('#amount').val(amount);
        });
    });
</script>
