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
                            <h4 class="card-title">Manage Inventory</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Qunty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Inventories as $Inventory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Inventory->name }}</td>
                                            <td>{{ $Inventory->price }}</td>
                                            <td>{{ $Inventory->qunty }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary edit_inventory"
                                                    data-id="{{ $Inventory->id }}"
                                                    data-name="{{ $Inventory->name }}"
                                                    data-price="{{ $Inventory->price }}"
                                                    data-qunty="{{ $Inventory->qunty }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('delete-inventory',['id' => $Inventory->id ]) }}" class="btn btn-danger">
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

<!-- Edit Inventory Modal -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInventoryModalLabel">Edit Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInventoryForm">
                    <input type="hidden" name="id" id="inventory_id">
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="inventory_name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" id="inventory_price" name="price" placeholder="Enter Price" required>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="inventory_qunty" name="qunty" placeholder="Enter Quantity" required>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
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
        $('.edit_inventory').on('click', function() {
            // Get data attributes from the clicked button
            var id = $(this).data('id');
            var name = $(this).data('name');
            var price = $(this).data('price');
            var qunty = $(this).data('qunty');

            // Set the values in the modal's input fields
            $('#inventory_id').val(id);
            $('#inventory_name').val(name);
            $('#inventory_price').val(price);
            $('#inventory_qunty').val(qunty);

            // Show the modal
            $('#editInventoryModal').modal('show');
        });

        $('#saveChanges').on('click', function() {
            var formData = $('#editInventoryForm').serialize();

            $.ajax({
                url: '/update-inventory',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response); // Log the response from the server
                    if (response.success) {
                        alert('Inventory updated successfully!');
                        location.reload();
                    } else {
                        alert('Error updating inventory');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log server-side error response
                    console.log(error); // Log client-side error
                    alert('Something went wrong!');
                }
            });
        });


    });
</script>