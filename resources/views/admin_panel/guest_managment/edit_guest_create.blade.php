@include('admin_panel.inlcude.header_include')

<style>
    .card {
        border: 1px solid #4d44b5;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
        margin-bottom: 10px;
        /* Reduced margin for better spacing */
        height: auto;
        /* Set height to auto */
        width: 100%;
        /* Full width */
    }

    .card-body {
        padding: 10px;
        /* Adjusted padding for better spacing */
    }

    .seat-available {
        background-color: #d4edda;
        /* Green background for available seats */
    }

    .seat-booked {
        background-color: #f8d7da;
        /* Red background for booked seats */
    }

    .card.disabled {
        opacity: 0.6;
        /* Disabled appearance */
    }

    .seat-container {
        display: flex;
        flex-wrap: wrap;
    }

    .seat-container .col-12 {
        margin-bottom: 10px;
    }

    .card.seat-available {
        background-color: #181818;
    }

    .card.seat-booked {
        background-color: #18181885;
        /* Red background for booked seats */
    }

    .card.disabled {
        opacity: 0.6;
        /* Disabled appearance */
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
                            <h4 class="card-title">Edit Guest</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('update-guest',['id' => $guest->id ]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $guest->name }}" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $guest->email }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" value="{{ $guest->mobile }}" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                                            <small class="text-muted">Leave blank if you do not want to change the password</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Booking Date</label>
                                            <input type="date" class="form-control" name="booking_date" value="{{ $guest->booking_date }}" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Upload CNIC Picture</label>
                                            <input type="file" class="form-control" name="cnic_pic">
                                            <small class="text-muted">Current: {{ $guest->cnic_pic }}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Type</label>
                                            <select class="form-control" name="id_type" required>
                                                <option value="CNIC" {{ $guest->id_type == 'CNIC' ? 'selected' : '' }}>CNIC</option>
                                                <option value="License" {{ $guest->id_type == 'License' ? 'selected' : '' }}>License</option>
                                                <option value="Passport" {{ $guest->id_type == 'Passport' ? 'selected' : '' }}>Passport</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Number</label>
                                            <input type="text" class="form-control" name="id_number" value="{{ $guest->id_number }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" required>{{ $guest->address }}</textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Select New Floor</label><br>
                                            <label class="form-label">Current Floor: <strong>{{ $guest->floor->floor_name }}</strong></label>
                                            <select name="floor_id" class="form-control" id="floor_id">
                                                <option disabled selected>Select floor</option>
                                                @foreach($Floors as $Floor)
                                                <!-- Don't pre-select any floor -->
                                                <option value="{{ $Floor->id }}">{{ $Floor->floor_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Rooms and Seats Containers -->
                                    <div class="row">
                                        <div id="rooms_container" class="mb-4 d-flex flex-wrap gap-3">
                                            <!-- Rooms will be appended here -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="seats_container" class="seat-container mb-4">
                                            <!-- Seats will be appended here -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <h4 id="total_charges" class="badge bg-primary p-3">Total Charges: 0</h4>
                                        </div>
                                    </div>
                                    <!-- Remaining form fields and submit button -->
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
                                    <button type="submit" class="btn btn-primary mt-2 mb-2">Update Guest</button>
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

                if (response.length > 0) {
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
                } else {
                    $('#rooms_container').append('<p>No rooms available for the selected floor.</p>');
                }
            },
            error: function(xhr, status) {
                console.error("Error fetching rooms: ", status);
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

<script>
    $(document).on('change', 'input[name="room_id"]', function() {
        var room_id = $(this).val();

        $.ajax({
            url: '/get-seats',
            method: 'GET',
            data: {
                room_id: room_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#seats_container').empty(); // Clear previous seats
                var seatRowAvailable = `<h5 class="mb-3 w-100">Available Seats</h5>`;
                var seatRowBooked = `<h5 class="mb-3 w-100">Booked Seats</h5>`;

                if (response.length > 0) {
                    $.each(response, function(index, seat) {
                        var seatCard = `
                            <div class="card ${seat.status === 'Booked' ? 'seat-booked disabled' : 'seat-available'}">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input seat-checkbox" type="checkbox" name="seats[]" value="${seat.id}" ${seat.status === 'Booked' ? 'disabled' : ''} id="seat_${seat.id}">
                                        <label class="form-check-label" for="seat_${seat.id}">
                                            Seat ${seat.seat_name}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        `;

                        if (seat.status === 'Booked') {
                            seatRowBooked += seatCard;
                        } else {
                            seatRowAvailable += seatCard;
                        }
                    });

                    $('#seats_container').append('<div class="col-12">' + seatRowAvailable + '</div>');
                    $('#seats_container').append('<div class="col-12">' + seatRowBooked + '</div>');
                } else {
                    $('#seats_container').append('<p>No seats available for the selected room.</p>');
                }
            },
            error: function(xhr, status) {
                console.error("Error fetching seats: ", status);
            }
        });
    });
</script>