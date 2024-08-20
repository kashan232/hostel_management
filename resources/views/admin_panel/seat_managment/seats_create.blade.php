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
                            <h4 class="card-title">Create Seat Setup</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('store-seat-setup') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Floor Name</label>
                                            <select class="form-control" name="floor_id" id="floorSelect" required>
                                                <option disabled selected>Select floor</option>
                                                @foreach($floors as $floor)
                                                <option value="{{ $floor->id }}">{{ $floor->floor_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="Status"> Status </label>
                                            <select name="status" id="Status" class="form-control">
                                                <option value="Available">Available</option>
                                                <option value="Booked">Booked</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Rooms</label>
                                            <div id="roomRadioGroup">
                                                <!-- Radio buttons for rooms will be appended here -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-12 mt-3">
                                            <label class="form-label">Seat Name</label>
                                            <input type="text" class="form-control" name="seat_name">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Seat</button>
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
    document.getElementById('floorSelect').addEventListener('change', function() {
        var floorId = this.value;
        var roomRadioGroup = document.getElementById('roomRadioGroup');
        roomRadioGroup.innerHTML = ''; // Clear any existing radio buttons

        if (floorId) {
            fetch(`/get-rooms/${floorId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.rooms && data.rooms.length > 0) {
                        data.rooms.forEach(function(room) {
                            var radioWrapper = document.createElement('div');
                            radioWrapper.className = 'form-check';

                            var radioInput = document.createElement('input');
                            radioInput.className = 'form-check-input';
                            radioInput.type = 'radio';
                            radioInput.name = 'room_id';
                            radioInput.value = room.id;
                            radioInput.id = `room_${room.id}`;

                            var radioLabel = document.createElement('label');
                            radioLabel.className = 'form-check-label';
                            radioLabel.htmlFor = `room_${room.id}`;
                            radioLabel.textContent = room.room_number;

                            radioWrapper.appendChild(radioInput);
                            radioWrapper.appendChild(radioLabel);
                            roomRadioGroup.appendChild(radioWrapper);
                        });
                    } else {
                        var noRoomsMessage = document.createElement('p');
                        noRoomsMessage.textContent = 'No rooms available for this floor.';
                        roomRadioGroup.appendChild(noRoomsMessage);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>