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
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Rooms</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Floor Name</th>
                                            <th>Room Number</th>
                                            <th>Room Type</th>
                                            <th>Number of Beds</th>
                                            <th>Amenities</th>
                                            <th>Status</th>
                                            <th>Charges</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Rooms as $Room)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Room->floor_id }}</td> <!-- Update this to show floor name if necessary -->
                                            <td>{{ $Room->room_number }}</td>
                                            <td>{{ $Room->room_type }}</td>
                                            <td>{{ $Room->number_of_beds }}</td>
                                            <td>{{ $Room->room_amenities }}</td>
                                            <td>
                                                @if($Room->occupancy_status == 'Available')
                                                <span class="badge rounded-pill text-bg-info">{{ $Room->occupancy_status }}</span>
                                                @else
                                                <span class="badge rounded-pill text-bg-danger">{{ $Room->occupancy_status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $Room->room_charges }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary edit_room"
                                                    data-id="{{ $Room->id }}"
                                                    data-floor_id="{{ $Room->floor_id }}"
                                                    data-room_number="{{ $Room->room_number }}"
                                                    data-room_type="{{ $Room->room_type }}"
                                                    data-number_of_beds="{{ $Room->number_of_beds }}"
                                                    data-room_amenities="{{ $Room->room_amenities }}"
                                                    data-occupancy_status="{{ $Room->occupancy_status }}"
                                                    data-room_charges="{{ $Room->room_charges }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a href="{{ route('delete-room',['id' => $Room->id ]) }}" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>

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

<!-- Edit Room Modal -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRoomForm">
                    <input type="hidden" name="id" id="room_id">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Floor Name</label>
                            <select class="form-control" id="room_floor_id" name="floor_id" required>
                                <option value="" disabled selected>Select floor</option>
                                @foreach($floors as $floor)
                                    <option value="{{ $floor->id }}">{{ $floor->floor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" placeholder="Enter room number" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Room Type</label>
                            <select class="form-control" id="room_type" name="room_type" required>
                                <option value="" disabled selected>Select room type</option>
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                                <option value="Suite">Suite</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Number of Beds</label>
                            <input type="number" class="form-control" id="number_of_beds" name="number_of_beds" placeholder="Enter number of beds" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Room Amenities</label>
                            <textarea class="form-control" id="room_amenities" name="room_amenities" placeholder="List room amenities (e.g., AC, Wi-Fi, TV)"></textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Occupancy Status</label>
                            <select class="form-control" id="occupancy_status" name="occupancy_status" required>
                                <option value="" disabled selected>Select occupancy status</option>
                                <option value="Available">Available</option>
                                <option value="Occupied">Occupied</option>
                                <option value="Under Maintenance">Under Maintenance</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Room Charges</label>
                            <input type="number" class="form-control" id="room_charges" name="room_charges" placeholder="Enter room charges" required>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="saveRoomChanges">Save changes</button>
                </form>
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
        // When edit button is clicked
        $('.edit_room').on('click', function() {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var floor_id = $(this).data('floor_id');
            var room_number = $(this).data('room_number');
            var room_type = $(this).data('room_type');
            var number_of_beds = $(this).data('number_of_beds');
            var room_amenities = $(this).data('room_amenities');
            var occupancy_status = $(this).data('occupancy_status');
            var room_charges = $(this).data('room_charges');

            // Set the values in the modal's input fields
            $('#room_id').val(id);
            $('#room_floor_id').val(floor_id);
            $('#room_number').val(room_number);
            $('#room_type').val(room_type);
            $('#number_of_beds').val(number_of_beds);
            $('#room_amenities').val(room_amenities);
            $('#occupancy_status').val(occupancy_status);
            $('#room_charges').val(room_charges);

            // Show the modal
            $('#editRoomModal').modal('show');
        });

        // Handle form submission and send AJAX request
        $('#saveRoomChanges').on('click', function() {
            var formData = $('#editRoomForm').serialize();

            $.ajax({
                url: '/update-room', // Adjust URL as needed
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Room updated successfully!');
                        location.reload(); // Reload the page to show updated data
                    } else {
                        alert('Error updating room');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Something went wrong!');
                }
            });
        });
    });
</script>
