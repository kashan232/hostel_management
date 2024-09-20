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
                            <h4 class="card-title">Create Floor</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name | Number | Rooms</th>
                                            <th>Type</th>
                                            <th>Total Area(sq ft)</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($floors as $floor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $floor->floor_name }} <br> {{ $floor->floor_number }} <br> {{ $floor->number_of_rooms }}</td>
                                            <td>{{ $floor->floor_type }}</td>
                                            <td>{{ $floor->total_area_sq_ft }}</td>
                                            <td>{{ $floor->floor_description }}</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-primary edit_floor"
                                                    data-id="{{ $floor->id }}"
                                                    data-floor_name="{{ $floor->floor_name }}"
                                                    data-floor_number="{{ $floor->floor_number }}"
                                                    data-number_of_rooms="{{ $floor->number_of_rooms }}"
                                                    data-floor_type="{{ $floor->floor_type }}"
                                                    data-total_area_sq_ft="{{ $floor->total_area_sq_ft }}"
                                                    data-floor_description="{{ $floor->floor_description }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('delete-floors',['id' => $floor->id ]) }}" class="btn btn-danger">
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

<!-- Edit Floor Modal -->
<div class="modal fade" id="editFloorModal" tabindex="-1" aria-labelledby="editFloorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFloorModalLabel">Edit Floor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFloorForm" method="POST">
                    @csrf
                    <input type="hidden" id="edit_floor_id" name="id">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Floor Name</label>
                            <input type="text" class="form-control" id="edit_floor_name" name="floor_name" placeholder="Enter floor name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Floor Number</label>
                            <input type="number" class="form-control" id="edit_floor_number" name="floor_number" placeholder="Enter floor number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Number of Rooms</label>
                            <input type="number" class="form-control" id="edit_number_of_rooms" name="number_of_rooms" placeholder="Enter total number of rooms on this floor" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Floor Type</label>
                            <select class="form-control" id="edit_floor_type" name="floor_type" required>
                                <option value="" disabled selected>Select floor type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Mixed-Use">Mixed-Use</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Total Area (sq ft)</label>
                            <input type="number" class="form-control" id="edit_total_area_sq_ft" name="total_area_sq_ft" placeholder="Enter total area in square feet" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Floor Description</label>
                            <textarea class="form-control" rows="6" id="edit_floor_description" name="floor_description" placeholder="Enter a detailed description of the floor"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Floor</button>
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
    $(document).ready(function() {
        $(".edit_floor").click(function() {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var floor_name = $(this).data('floor_name');
            var floor_number = $(this).data('floor_number');
            var number_of_rooms = $(this).data('number_of_rooms');
            var floor_type = $(this).data('floor_type');
            var total_area_sq_ft = $(this).data('total_area_sq_ft');
            var floor_description = $(this).data('floor_description');

            // Set the values in the modal's input fields
            $("#edit_floor_id").val(id);
            $("#edit_floor_name").val(floor_name);
            $("#edit_floor_number").val(floor_number);
            $("#edit_number_of_rooms").val(number_of_rooms);
            $("#edit_floor_type").val(floor_type);
            $("#edit_total_area_sq_ft").val(total_area_sq_ft);
            $("#edit_floor_description").val(floor_description);

            // Show the modal
            $("#editFloorModal").modal("show");
        });
    });

    $("#editFloorForm").submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var id = $("#edit_floor_id").val();

        $.ajax({
            url: '/floors-update/' + id,
            type: 'GET',
            data: formData,
            success: function(response) {
                alert(response.success);
                // Close the modal
                $("#editFloorModal").modal("hide");
                // Optionally reload the page or update the table row
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>