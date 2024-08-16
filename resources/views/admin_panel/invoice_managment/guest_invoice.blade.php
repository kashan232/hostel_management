@include('admin_panel.inlcude.header_include')

<style>
    .card {
        border: 1px solid #4d44b5;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .badge.bg-primary {
        font-size: 1.25rem;
        font-weight: bold;
    }
</style>

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
                            <h4 class="card-title">Create Guest</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('store-guest') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" placeholder="Enter mobile number" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Booking Date</label>
                                            <input type="date" class="form-control" name="booking_date" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Upload CNIC Picture</label>
                                            <input type="file" class="form-control" name="cnic_pic" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Type</label>
                                            <select class="form-control" name="id_type" required>
                                                <option disabled selected>Select ID type</option>
                                                <option value="CNIC">CNIC</option>
                                                <option value="License">License</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Number</label>
                                            <input type="text" class="form-control" name="id_number" placeholder="Enter ID number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Enter home address" required></textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Select Floor</label>
                                            <select name="floor_id" class="form-control" id="floor_id" required>
                                                <option disabled selected>Select floor</option>
                                                @foreach($Floors as $Floor)
                                                <option value="{{ $Floor->id }}">{{ $Floor->floor_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="rooms_container" class="mb-4 d-flex flex-wrap gap-3">
                                            <!-- Rooms will be appended here -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <h4 id="total_charges" class="badge bg-primary p-3">Total Charges: 0</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Lease Period (From)</label>
                                            <input type="date" class="form-control" name="lease_from" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Lease Period (To)</label>
                                            <input type="date" class="form-control" name="lease_to" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register Tenant</button>
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
    $('#floor_id').on('change', function() {
        var floor_id = $(this).val();

        $.ajax({
            url: '/get-rooms',
            method: 'GET',
            data: {
                floor_id: floor_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#rooms_container').empty(); // Clear previous rooms
                var roomRow = `<h5 class="mb-3 w-100">Select Room</h5>`;

                $.each(response, function(index, room) {
                    var roomCard = `
                    <div class="card" style="width: 200px;">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input room-radio" type="radio" name="room_id" value="${room.id}" data-room-charges="${room.room_charges}" id="room_${room.id}">
                                <label class="form-check-label" for="room_${room.id}">
                                    Room ${room.room_number} <br> <span class="text-muted">Charges: ${room.room_charges}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                `;
                    roomRow += roomCard;
                });

                $('#rooms_container').append(roomRow);
            },
            error: function(xhr, status) {
                console.error("Error: ", status);
            }
        });
    });

    // Calculate total charges
    $(document).on('change', '.room-radio, input[name="lease_from"], input[name="lease_to"]', function() {
        calculateTotalCharges();
    });

    function calculateTotalCharges() {
        var totalCharges = 0;
        var selectedRoom = $('.room-radio:checked');
        var leaseFrom = $('input[name="lease_from"]').val();
        var leaseTo = $('input[name="lease_to"]').val();

        if (selectedRoom.length > 0 && leaseFrom && leaseTo) {
            var startDate = new Date(leaseFrom);
            var endDate = new Date(leaseTo);
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            var roomCharges = parseFloat(selectedRoom.data('room-charges'));
            totalCharges = roomCharges * diffDays;

            $('#total_charges').text(`Total Charges: ${totalCharges}`);
        }
    }
</script>
