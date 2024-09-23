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
                            <h4 class="card-title">Manage Seats Setup</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Floor Name</th>
                                            <th>Room Number</th>
                                            <th>Seat Name</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Seats as $Seat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Seat->floor->floor_name }}</td> <!-- Floor Name -->
                                            <td>{{ $Seat->room->room_number }}</td> <!-- Room Number -->
                                            <td>{{ $Seat->seat_name }}</td>
                                            <td>
                                                @if($Seat->status == 'Available')
                                                <span class="badge rounded-pill text-bg-info">{{ $Seat->status }}</span>
                                                @else
                                                <span class="badge rounded-pill text-bg-danger">{{ $Seat->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary edit_Seat"
                                                    data-id="{{ $Seat->id }}"
                                                    data-floor="{{ $Seat->floor_id }}"
                                                    data-room="{{ $Seat->room_id }}"
                                                    data-name="{{ $Seat->seat_name }}"
                                                    data-status="{{ $Seat->status }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>


                                                <a href="{{ route('delete-seat',['id' => $Seat->id ]) }}" class="btn btn-danger">
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

<!-- Edit Seat Modal -->
<div class="modal fade" id="editSeatModal" tabindex="-1" aria-labelledby="editSeatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSeatModalLabel">Edit Seat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSeatForm">
                    <input type="hidden" name="seat_id" id="editSeatId">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Floor Name</label>
                            <select class="form-control" name="floor_id" id="editFloorSelect" required>
                                <option disabled>Select floor</option>
                                @foreach($floors as $floor)
                                <option value="{{ $floor->id }}">{{ $floor->floor_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Status"> Status </label>
                            <select name="status" id="editStatus" class="form-control">
                                <option value="Available">Available</option>
                                <option value="Booked">Booked</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Rooms</label>
                            <div id="editRoomRadioGroup">
                                <!-- Radio buttons for rooms will be appended here based on selected floor -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12 mt-3">
                            <label class="form-label">Seat Name</label>
                            <input type="text" class="form-control" name="seat_name" id="editSeatName">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
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
    document.querySelectorAll('.edit_Seat').forEach(button => {
        button.addEventListener('click', function() {
            var seatId = this.getAttribute('data-id');
            var floorId = this.getAttribute('data-floor');
            var roomId = this.getAttribute('data-room');
            var seatName = this.getAttribute('data-name');
            var status = this.getAttribute('data-status');

            // Populate the modal with the existing data
            document.getElementById('editSeatId').value = seatId;
            document.getElementById('editSeatName').value = seatName;
            document.getElementById('editFloorSelect').value = floorId;
            document.getElementById('editStatus').value = status;

            // Fetch the rooms for the selected floor and check the correct room
            fetch(`/get-rooms/${floorId}`)
                .then(response => response.json())
                .then(data => {
                    var roomRadioGroup = document.getElementById('editRoomRadioGroup');
                    roomRadioGroup.innerHTML = ''; // Clear existing radio buttons

                    data.rooms.forEach(function(room) {
                        var radioWrapper = document.createElement('div');
                        radioWrapper.className = 'form-check';

                        var radioInput = document.createElement('input');
                        radioInput.className = 'form-check-input';
                        radioInput.type = 'radio';
                        radioInput.name = 'room_id';
                        radioInput.value = room.id;
                        radioInput.id = `edit_room_${room.id}`;

                        // Check the selected room
                        if (room.id == roomId) {
                            radioInput.checked = true;
                        }

                        var radioLabel = document.createElement('label');
                        radioLabel.className = 'form-check-label';
                        radioLabel.htmlFor = `edit_room_${room.id}`;
                        radioLabel.textContent = room.room_number;

                        radioWrapper.appendChild(radioInput);
                        radioWrapper.appendChild(radioLabel);
                        roomRadioGroup.appendChild(radioWrapper);
                    });
                });

            // Show the modal
            var editModal = new bootstrap.Modal(document.getElementById('editSeatModal'));
            editModal.show();
        });
    });

    document.getElementById('editSeatForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData(this);

        // Submit the form using AJAX with POST method
        fetch('/update-seat', {
                method: 'POST', // Changed to POST
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Handle success (e.g., reload the page or update the table row)
                    location.reload();
                } else {
                    // Handle error case (e.g., show error message)
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>