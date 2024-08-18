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
                            <div class="card-body">
                                <p>Email: {{ $guest->email }}</p>
                                <p>Mobile: {{ $guest->mobile }}</p>
                                <p>Booking Date: {{ $guest->booking_date }}</p>
                                <p>Floor: {{ $guest->floor->floor_name }}</p>
                                <p>Room: {{ $guest->room->room_number }}</p>
                                <p>Charges per Day: {{ $guest->room_charges }}</p>
                                <p>Total Days: {{ $guest->lease_from->diffInDays($guest->lease_to) }}</p>
                                <p>Total Service Charges: {{ $guest->total_service_charges }}</p>
                                <p>Total Charges: {{ $guest->total_charges }}</p>
                                <p>Lease From: {{ $guest->lease_from->toDateString() }}</p>
                                <p>Lease To: {{ $guest->lease_to->toDateString() }}</p>
                                <p>Status: {{ $guest->status }}</p>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="display table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Name | Email | Mobile</th>
                                            <th>Booking Date</th>
                                            <th>Floor</th>
                                            <th>Room</th>
                                            <th>Charges</th>
                                            <th>Total Charges</th>
                                            <th>Lease From</th>
                                            <th>Lease To</th>
                                            <th>Status</th>
                                            <th>Booking</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
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
