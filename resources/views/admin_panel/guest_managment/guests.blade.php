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
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}|{{ $service->service_name }}"
                                    data-amount="{{ $service->amount }}">{{ $service->service_name }}</option>
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
    <div class="modal fade" id="viewServicesModal" tabindex="-1" aria-labelledby="viewServicesModalLabel"
        aria-hidden="true">
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


    <!-- Add Recurring Service Modal -->
    <div class="modal fade" id="addRecurringServiceModal" tabindex="-1" aria-labelledby="addRecurringServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRecurringServiceModalLabel">Add Recurring Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guest.addRecurringService') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="guest_id" id="recurring_guest_id">
                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="month" name="month" id="month" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input type="text" name="service_name" id="service_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="recurring_amount">Amount</label>
                            <input type="number" name="amount" id="recurring_amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Recurring Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Advance Payment Modal -->
    <div class="modal fade" id="addAdvancePaymentModal" tabindex="-1" aria-labelledby="addAdvancePaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdvancePaymentModalLabel">Add Advance Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guest-advance-payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="guest_id" id="advance_guest_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="advance_amount">Total Charges</label>
                            <input type="number" name="total_charges" id="total_charges_guest" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="advance_amount">Advance Amount</label>
                            <input type="number" name="advance_amount" id="advance_amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="advance_date">Payment Date</label>
                            <input type="date" name="advance_date" id="advance_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Recurring Services Modal -->
    <!-- Recurring Services Modal -->
    <div class="modal fade" id="viewRecurringServiceModal" tabindex="-1" aria-labelledby="viewRecurringServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRecurringServiceModalLabel">Recurring Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Service Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="recurringServiceList">
                            <!-- Recurring Services will be loaded here via AJAX -->
                        </tbody>
                    </table>
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
                                            <th>Seat</th>
                                            <th>Room Charges</th>
                                            <th>Service Charges</th>
                                            <th>Recurring Service Charges</th>
                                            <th>Total Charges</th>
                                            <th>Advance Payment</th> <!-- New column -->
                                            <th>Lease From</th>
                                            <th>Lease To</th>
                                            <th>Status</th>
                                            <th>Booking</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guests as $guest)
                                        <tr>
                                            <td>{{ $guest->name }} <br> {{ $guest->email }} <br>
                                                {{ $guest->mobile }}
                                            </td>
                                            <td>{{ $guest->booking_date }}</td>
                                            <td>{{ $guest->floor ? $guest->floor->floor_name : 'No floor assigned' }}</td>
                                            <td>{{ $guest->room ? $guest->room->room_number : 'No room assigned' }}</td>
                                            <td>
                                                @if($guest->seats->isNotEmpty())
                                                @foreach($guest->seats as $seat)
                                                {{ $seat->seat_name }}@if (!$loop->last), @endif
                                                @endforeach
                                                @else
                                                No seats assigned
                                                @endif
                                            </td>
                                            <td>{{ $guest->room_charges }}</td>
                                            <td>{{ $guest->total_service_charges }}</td>
                                            <td>{{ $guest->totalRecurringCharges }}</td>
                                            <td>{{ $guest->total_charges }}</td>
                                            <td>{{ $guest->advance_amount ?? 'N/A' }} <br> {{ $guest->advance_date ?? 'N/A' }}</td> <!-- New column -->
                                            <td>{{ $guest->lease_from }}</td>
                                            <td>{{ $guest->lease_to }}</td>
                                            <td>
                                                @if ($guest->status === 'Check-In')
                                                <span class="badge bg-success">Checked In</span>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdvancePaymentModal"
                                                    data-guest-id="{{ $guest->id }}" data-total-charges="{{ $guest->total_charges }}">Add Advance Payment</button>
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- End Booking Button -->
                                                <!-- @if ($guest->status === 'Check-In')
                                                
                                                @else
                                                <span class="badge bg-danger">Checked Out</span>
                                                @endif -->

                                                @if ($guest->status === 'Check-In')
                                                <button class="btn btn-danger btn-sm end-booking-btn"
                                                    data-guest-id="{{ $guest->id }}">End Booking</button>
                                                @elseif($guest->status == 'Check-Out')
                                                <span class="btn btn-primary btn-sm">Check-Out</span>
                                                @elseif($guest->status == 'Paid')
                                                <span class="btn btn-success btn-sm">Paid</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($guest->status === 'Check-Out')
                                                <span class="badge bg-primary">No Action</span>
                                                @elseif($guest->status == 'Paid')
                                                <span class="badge bg-primary">No Action</span>
                                                @else

                                                <div style="display: flex;padding:0 5px;">
                                                    <div class="basic-dropdown">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-primary ult dropdown-toggle" data-bs-toggle="dropdown">
                                                                Charge Services
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="javascript:void(0);" class="dropdown-item btn btn-success" data-bs-toggle="modal"
                                                                    data-bs-target="#addServiceModal"
                                                                    data-guest-id="{{ $guest->id }}">Add Service</a>

                                                                <a href="javascript:void(0);" class="dropdown-item btn btn-info" data-bs-toggle="modal"
                                                                    data-bs-target="#viewServicesModal"
                                                                    data-guest-id="{{ $guest->id }}">View Services</a>

                                                                <a href="javascript:void(0);" class="dropdown-item btn btn-warning" data-bs-toggle="modal"
                                                                    data-bs-target="#addRecurringServiceModal" data-guest-id="{{ $guest->id }}">
                                                                    Add Recurring Service
                                                                </a>

                                                                <a href="javascript:void(0);" class="dropdown-item btn btn-secondary viewRecurringServicesBtn" data-bs-toggle="modal" data-bs-target="#viewRecurringServiceModal" data-guest-id="{{ $guest->id }}">
                                                                    View Recurring Service
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('edit-guest',['id' => $guest->id ]) }}" class="btn btn-primary edit_room">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>

                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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

        $('#addAdvancePaymentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var guestId = button.data('guest-id');
            var total = button.data('total-charges');
            var modal = $(this);
            modal.find('#advance_guest_id').val(guestId);
            modal.find('#total_charges_guest').val(total);
        });

        $('#addRecurringServiceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var guestId = button.data('guest-id');
            var modal = $(this);
            modal.find('#recurring_guest_id').val(guestId);
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
                        $('#guest-services-list').append('<tr><td>' + service
                            .service_name + '</td><td>' + service.amount +
                            '</td></tr>');
                        totalAmount += parseFloat(service.amount);
                    });
                }
            });

            // Display the total amount
            $('#total-amount').text(totalAmount);
        });
    });


    // Trigger the AJAX call when the "View Recurring Service" button is clicked
    $(document).on('click', '.viewRecurringServicesBtn', function() {
        var guestId = $(this).data('guest-id'); // Fetch guest id from button
        console.log(guestId); // Use console.log for better debugging than alert

        $.ajax({
            url: '/get-recurring-services', // The URL of your route that fetches recurring services
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}', // CSRF token
                guest_id: guestId
            },
            success: function(response) {
                // Clear the existing list
                $('#recurringServiceList').empty();

                // Check if there are services to show
                if (response.services && response.services.length > 0) {
                    // Loop through the services and append rows to the modal table
                    response.services.forEach(function(service) {
                        $('#recurringServiceList').append(`
                        <tr>
                            <td>${service.formatted_date}</td>
                            <td>${service.service_name}</td>
                            <td>${service.amount}</td> <!-- Assuming start_date is created_at -->
                        </tr>
                    `);
                    });
                } else {
                    // If no services found
                    $('#recurringServiceList').append(`
                    <tr>
                        <td colspan="4" class="text-center">No recurring services found for this guest.</td>
                    </tr>
                `);
                }

                // Show the modal after the services are fetched
                $('#viewRecurringServiceModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error); // Handle error
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.end-booking-btn').click(function() {
            var guestId = $(this).data('guest-id');

            if (confirm('Are you sure you want to end the booking for this guest?')) {
                $.ajax({
                    url: '{{ route('endBooking') }}', // Route for handling the request
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