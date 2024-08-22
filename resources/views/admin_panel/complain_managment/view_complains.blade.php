@include('admin_panel.inlcude.header_include')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Action on complain</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="complaintForm">
                        <div class="alert alert-success text-dark" role="alert" id="alertmessage" style="display: none;"></div>
                        <input type="hidden" name="complain_id" value="{{ $complain->id }}" readonly>
                        <div class="form-group">

                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="In-Process">In process</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark:</label>
                            <textarea class="form-control" id="remark" name="remark" rows="5"></textarea>
                        </div>
                        <div class=" w-100 text-right">
                            <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">View Complaints Details </h4>
                            <!-- <a href="#" class="btn btn-success text-white" id="generatePdfBtn">Generate PDF</a> -->
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <hr>
                                <table class="table table-bordered">
                                    <tbody>

                                        <tr>
                                            <td><b>Complaint Number</b></td>
                                            <td> {{ $complain->id }} </td>
                                            <td><b>Title </b></td>
                                            <td> {{ $complain->complaint_title }} </td>
                                            <td><b> Date Of Complainant</b></td>
                                            <td> {{ $complain->complaint_date }} </td>

                                        </tr>
                                        <tr>
                                            <td><b>Type</b></td>
                                            <td> {{ $complain->complaint_type }} </td>
                                            <td><b>Image</b></td>
                                            <td> {{ $complain->complaint_type }} </td>
                                        </tr>
                                        <tr>
                                            <td><b>Description </b></td>
                                            <td colspan="6"> {{ $complain->complaint_description }}.</td>
                                        </tr>
                                        <tr>
                                            <td><b>Final Status</b></td>
                                            <td colspan="6">
                                                @if($complain->status == 'Un-Resolved')
                                                <span class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </span>
                                                @elseif($complain->status == 'In-Process')
                                                <span class="btn btn-primary btn-sm">In-Progress</span>
                                                @elseif($complain->status == 'Closed')
                                                <span class="btn btn-success btn-sm">Closed</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>S.No</th>
                                            <th colspan="3">Remark</th>
                                            <th>Status</th>
                                            <th>Updation Date</th>
                                        </tr>
                                        @foreach($complaint_remarks as $complaint_remark)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td colspan="3">{{ $complaint_remark->remark }}</td>
												<td>
													@if($complaint_remark->status == 'Un-Resolved')
													<span class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </span>
													@elseif($complaint_remark->status == 'In-Process')
													<span class="btn btn-primary btn-sm">In-Progress</span>
													@elseif($complaint_remark->status == 'Closed')
													<span class="btn btn-success btn-sm">Closed</span>
													@endif
												</td>
												<td>{{ $complaint_remark->updated_at->format('F j, Y') }}</td>
											</tr>
										@endforeach
                                        <tr>
                                            <td>
                                                @if($complain->status == 'Closed')
													<span class="btn btn-success btn-sm">Complain is closed no action performed</span>
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Take Action</button>
                                                @endif
                                            </td>
                                        </tr>
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
        // Add click event to the button with id "submitBtn"
        $('#submitBtn').on('click', function() {
            // Create a JavaScript object to represent form data
            var formData = {
                complain_id: $('[name="complain_id"]').val(),
                status: $('#status').val(),
                remark: $('#remark').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Perform AJAX submission
            $.ajax({
                type: 'POST',
                url: '/action-on-complaint',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    // Handle the success response
                    var message = response.message;

                    // Update the HTML content of the element with the ID "lock_message"
                    $("#alertmessage").html(message).show();
                    // Show the response message in your modal or wherever needed
                    // Trigger the success modal after 2 seconds
                    setTimeout(function() {
                        $('#successMessage').html(message);
                        $('#successModal').modal('show');
                    }, 1000);

                    // Refresh the page after 4 seconds
                    setTimeout(function() {
                        location.reload();
                    }, 3000);


                },
                error: function(error) {
                    // Handle the error response
                    console.error(error);
                    // Show the error message in your modal or wherever needed
                    alert('Error: ' + error.responseJSON.error);
                }
            });
        });
    });
</script>