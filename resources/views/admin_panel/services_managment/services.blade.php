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
                            <h4 class="card-title">Manage Service</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Service Name</th>
                                            <th>Service Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->service_name}}</td>
                                            <td>{{ $service->amount}}</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-primary edit_service"
                                                    data-id="{{ $service->id }}"
                                                    data-service_name="{{ $service->service_name }}"
                                                    data-amount="{{ $service->amount }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('delete-service',['id' => $service->id ]) }}" class="btn btn-danger">
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

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm" method="POST">
                    @csrf
                    <input type="hidden" id="edit_service_id" name="id">
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="edit_service_name" name="service_name" placeholder="Enter service name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" id="edit_service_amount" name="amount" placeholder="Enter amount" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Service</button>
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
        $(".edit_service").click(function() {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var service_name = $(this).data('service_name');
            var amount = $(this).data('amount');

            // Set the values in the modal's input fields
            $("#edit_service_id").val(id);
            $("#edit_service_name").val(service_name);
            $("#edit_service_amount").val(amount);

            // Show the modal
            $("#editServiceModal").modal("show");
        });
    });

    $("#editServiceForm").submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    var id = $("#edit_service_id").val();

    $.ajax({
        url: '/service-update/' + id,
        type: 'GET',
        data: formData,
        success: function(response) {
            alert(response.success);
            // Close the modal
            $("#editServiceModal").modal("hide");
            // Optionally reload the page or update the table row
            location.reload();
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});


</script>
