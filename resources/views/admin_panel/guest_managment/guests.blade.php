@include('admin_panel.inlcude.header_include')
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
    @include('admin_panel.inlcude.top_sidebar_include')

    <!--**********************************
            Nav header end
        ***********************************-->
    <!--**********************************
            Header start
        ***********************************-->
    @include('admin_panel.inlcude.navbar_include')
    <!--**********************************
            Header end 
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    @include('admin_panel.inlcude.sidebar_include')
    <!--**********************************
            Sidebar end
        ***********************************-->
    <!--**********************************
            Content body start
        ***********************************-->
    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addServiceModalLabel">Add New Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guest.addService') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="guest_id" id="guest_id">
                        <div class="form-group">
                            <label for="service_id">Select Service</label>
                            <select name="service_info" id="service_id" class="form-control" required>
                                <option value="">--Select Service--</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}|{{ $service->service_name }}" data-amount="{{ $service->amount }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- View Services Modal -->
    <div class="modal fade" id="viewServicesModal" tabindex="-1" aria-labelledby="viewServicesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewServicesModalLabel">Guest Services</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="guest-services-list">
                            <!-- Services will be listed here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <h5>Total: <span id="total-amount"></span></h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Guest</h4>
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
                                            <th>Charges</th>
                                            <th>Total Charges</th>
                                            <th>Lease From</th>
                                            <th>Lease To</th>
                                            <th>Status</th>
                                            <th>Booking</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($guests as $guest)
                                        <tr>
                                            <td>{{ $guest->name }} <br> {{ $guest->email }} <br> {{ $guest->mobile }} </td>
                                            <td>{{ $guest->booking_date }}</td>
                                            <td>{{ $guest->floor->floor_name }}</td>
                                            <td>{{ $guest->room->room_number }}</td>
                                            <td>{{ $guest->room_charges }}</td>
                                            <td>{{ $guest->total_charges }}</td>
                                            <td>{{ $guest->lease_from }}</td>
                                            <td>{{ $guest->lease_to }}</td>
                                            <td>
                                                @if($guest->status === 'Check-In')
                                                <span class="badge bg-success">Checked In</span>
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif

                                            </td>
                                            <td>
                                                <!-- End Booking Button -->
                                                @if($guest->status === 'Check-In')
                                                <button class="btn btn-danger btn-sm end-booking-btn" data-guest-id="{{ $guest->id }}">End Booking</button>
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($guest->status === 'Check-Out')
                                                    <span class="badge bg-primary">No Action</span>
                                                @else
                                                <a href="#" class="btn btn-primary">Edit</a>
                                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addServiceModal" data-guest-id="{{ $guest->id }}">Add Service</a>
                                                <a href="#" class="btn btn-info" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#viewServicesModal" data-guest-id="{{ $guest->id }}">View Services</a>
                                                @endif



                                            </td>
                                        </tr>
                                        @endforeach
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
@include('admin_panel.inlcude.copyright_include')

</div>
<!--**********************************
        Scripts
    ***********************************-->
@include('admin_panel.inlcude.footer_include')

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

<script>
    $(document).ready(function() {
        $('#viewServicesModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var guestId = button.data('guest-id');
            var modal = $(this);

            // Clear the list first
            $('#guest-services-list').empty();
            var totalAmount = 0;

            // Find the guest by ID and populate the services
            @json($guests).forEach(function(guest) {
                if (guest.id == guestId) {
                    guest.services.forEach(function(service) {
                        $('#guest-services-list').append('<tr><td>' + service.service_name + '</td><td>' + service.amount + '</td></tr>');
                        totalAmount += parseFloat(service.amount);
                    });
                }
            });

            // Display the total amount
            $('#total-amount').text(totalAmount);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.end-booking-btn').click(function() {
            var guestId = $(this).data('guest-id');

            if (confirm('Are you sure you want to end the booking for this guest?')) {
                $.ajax({
                    url: '{{ route("endBooking") }}', // Route for handling the request
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        guest_id: guestId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Booking ended successfully.');
                            location.reload(); // Refresh the page to update the status
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        });
    });
</script>