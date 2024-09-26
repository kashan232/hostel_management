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
                            <h4 class="card-title">Manage Notice</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Notice Title</th>
                                            <th>Notice Date</th>
                                            <th>Expiry Date</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Notices as $notice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $notice->title }}</td>
                                            <td>{{ $notice->notice_date }}</td>
                                            <td>{{ $notice->expiry_date ?? 'No Expiry' }}</td>
                                            <td>{{ $notice->description }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary edit_notice"
                                                    data-id="{{ $notice->id }}"
                                                    data-title="{{ $notice->title }}"
                                                    data-notice_date="{{ $notice->notice_date }}"
                                                    data-expiry_date="{{ $notice->expiry_date }}"
                                                    data-description="{{ $notice->description }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a href="{{ route('delete-notices',['id' => $notice->id ]) }}" class="btn btn-danger">
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


<!-- Edit Notice Modal -->
<div class="modal fade" id="editNoticeModal" tabindex="-1" aria-labelledby="editNoticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editNoticeForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNoticeModalLabel">Edit Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-notice-id">
                    <div class="row">
                        <!-- Notice Title -->
                        <div class="mb-3 col-md-12">
                            <label for="edit-notice-title" class="form-label">Notice Title</label>
                            <input type="text" name="title" id="edit-notice-title" class="form-control" required>
                        </div>
                        <!-- Notice Date -->
                        <div class="mb-3 col-md-6">
                            <label for="edit-notice-date" class="form-label">Notice Date</label>
                            <input type="date" name="notice_date" id="edit-notice-date" class="form-control" required>
                        </div>
                        <!-- Expiry Date -->
                        <div class="mb-3 col-md-6">
                            <label for="edit-expiry-date" class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" id="edit-expiry-date" class="form-control">
                        </div>
                        <!-- Notice Description -->
                        <div class="mb-3 col-md-12">
                            <label for="edit-notice-description" class="form-label">Notice Description</label>
                            <textarea name="description" id="edit-notice-description" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Notice</button>
                </div>
            </form>
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
    $(document).on('click', '.edit_notice', function() {
        var noticeId = $(this).data('id');
        var noticeTitle = $(this).data('title');
        var noticeDate = $(this).data('notice_date');
        var expiryDate = $(this).data('expiry_date');
        var description = $(this).data('description');

        // Set the form field values
        $('#edit-notice-id').val(noticeId);
        $('#edit-notice-title').val(noticeTitle);
        $('#edit-notice-date').val(noticeDate);
        $('#edit-expiry-date').val(expiryDate);
        $('#edit-notice-description').val(description);

        // Show the modal
        $('#editNoticeModal').modal('show');
    });

    $('#editNoticeForm').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            id: $('#edit-notice-id').val(),
            title: $('#edit-notice-title').val(),
            notice_date: $('#edit-notice-date').val(),
            expiry_date: $('#edit-expiry-date').val(),
            description: $('#edit-notice-description').val(),
        };

        $.ajax({
            url: '/notices/update', // Update the URL as per your route
            type: 'PUT', // Use the appropriate HTTP method
            data: formData,
            headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            success: function(response) {
                if (response.success) {
                    // Hide the modal
                    $('#editNoticeModal').modal('hide');

                    // Optionally, refresh the table or update the row data in the table
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert('Something went wrong!');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Log any errors
            }
        });
    });
</script>