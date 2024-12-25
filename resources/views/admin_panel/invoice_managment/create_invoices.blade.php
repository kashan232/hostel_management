@include('admin_panel.inlcude.header_include')
<!--*******************
        Preloader end
    ********************-->
<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper" class="wallet-open active">
    @include('admin_panel.inlcude.top_sidebar_include')
    @include('admin_panel.inlcude.navbar_include')
    @include('admin_panel.inlcude.sidebar_include')
    <style>
        #guestDetails div {
            margin: 10px 0;
        }
    </style>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create Invoice</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('save.payment') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="guest">Select Guest:</label>
                                        <select id="single-select" name="guest_id" class="form-control">
                                            <option value="">Choose Guest</option>
                                            @foreach($guests as $guest)
                                            <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="guestDetails" style="display:none;">
                                        <!-- Existing Invoice Details -->
                                        <div class="form-group">
                                            <label>Lease From:</label>
                                            <input type="text" id="leaseFrom" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Lease To:</label>
                                            <input type="text" id="leaseTo" class="form-control" readonly>
                                        </div>

                                        <!-- Example form inputs -->
                                        <div>
                                            <label for="roomCharges">Room Charges:</label>
                                            <input type="text" id="roomCharges" name="roomCharges" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="totalCharges">Total Charges:</label>
                                            <input type="text" id="totalCharges" name="totalCharges" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="advanceAmount">Advance Amount:</label>
                                            <input type="text" id="advanceAmount" name="advanceAmount" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="advanceDate">Advance Date:</label>
                                            <input type="text" id="advanceDate" name="advanceDate" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="status">Status:</label>
                                            <span id="status"></span>
                                        </div>

                                        <!-- Services Table -->
                                        <h5>Services</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceList">
                                                <!-- Regular Services Will Be Fetched and Inserted Here -->
                                            </tbody>
                                        </table>


                                        <!-- Recurring Services Table -->
                                        <h5>Recurring Services</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Amount</th>
                                                    <th>Month</th>
                                                </tr>
                                            </thead>
                                            <tbody id="recurringServiceList">
                                                <!-- Recurring Services Will Be Fetched and Inserted Here -->
                                            </tbody>
                                        </table>

                                        <!-- Payment Section -->
                                        <hr>
                                        <h5>Payment Details</h5>
                                        <div>
                                            <label for="totalDue">Total Due:</label>
                                            <input type="text" id="totalDue" name="total_due" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="amountToPay">Amount to Pay:</label>
                                            <input type="number" id="amountToPay" name="amount_to_pay" class="form-control">
                                        </div>
                                        <div>
                                            <label for="remainingDue">Remaining Due:</label>
                                            <input type="text" id="remainingDue" name="remaining_due" class="form-control" readonly>
                                        </div>
                                        <div>
                                            <label for="paymentMethod">Payment Method:</label>
                                            <select id="paymentMethod" name="payment_method" class="form-control">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2 mb-2">Submit Payment</button>
                                    </div>
                                </form>
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
        $('#guestSelect').on('change', function() {
            var guestId = $(this).val();

            if (guestId) {
                $.ajax({
                    url: '/get-guest-details',
                    type: 'GET',
                    data: {
                        guest_id: guestId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Assign the basic guest info
                        $('#leaseFrom').val(response.lease_from);
                        $('#leaseTo').val(response.lease_to);
                        $('#roomCharges').val(response.room_charges);
                        $('#totalCharges').val(response.total_charges);
                        $('#advanceAmount').val(response.advance_amount);
                        $('#advanceDate').val(response.advance_date);
                        $('#status').text(response.status); // Display guest's status

                        // Clear previous service lists
                        $('#serviceList').empty();
                        $('#recurringServiceList').empty();

                        // Sum up the service amounts
                        let totalServices = 0;
                        response.services.forEach(function(service) {
                            $('#serviceList').append(`
                            <tr>
                                <td>${service.service_name}</td>
                                <td>${service.amount}</td>
                            </tr>
                        `);
                            totalServices += parseFloat(service.amount);
                        });

                        // Sum up the recurring service amounts
                        let totalRecurringServices = 0;
                        response.recurringServices.forEach(function(service) {
                            $('#recurringServiceList').append(`
                            <tr>
                                <td>${service.service_name}</td>
                                <td>${service.amount}</td>
                                <td>${service.month}</td>
                            </tr>
                        `);
                            totalRecurringServices += parseFloat(service.amount);
                        });

                        // Calculate Total Due: Total Charges - Advance + Services + Recurring Services
                        let totalDue = (parseFloat(response.total_charges) - parseFloat(response.advance_amount)) + totalServices + totalRecurringServices;

                        // Update Total Due
                        $('#totalDue').val(totalDue.toFixed(2)); // Set calculated Total Due

                        // Show guest details section
                        $('#guestDetails').show();
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching guest details');
                    }
                });
            } else {
                $('#guestDetails').hide();
            }
        });

        // Update remaining due when amount to pay is input
        $('#amountToPay').on('input', function() {
            let totalDue = parseFloat($('#totalDue').val());
            let amountToPay = parseFloat($(this).val());

            if (amountToPay > totalDue) {
                $('#remainingDue').val(0);
            } else {
                $('#remainingDue').val((totalDue - amountToPay).toFixed(2));
            }
        });
    });
</script>