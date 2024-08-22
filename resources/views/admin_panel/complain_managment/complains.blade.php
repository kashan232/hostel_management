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
                            <h4 class="card-title">Registered Complains</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Date | Complaint Title</th>
                                            <th>Complaint Type</th>
                                            <th>Complaint Description</th>
                                            <th>Complaint Picture</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Complains as $complain)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $complain->complaint_date }} <br>{{ $complain->complaint_title }}</td>
                                            <td>{{ $complain->complaint_type }}</td>
                                            <td>{{ $complain->complaint_description }}</td>
                                            <td>
                                                @if($complain->complaint_pic)
                                                <img src="{{ asset('complain_images/' . $complain->complaint_pic) }}" alt="Complaint Image" width="50">
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                            <td>
                                                @if($complain->status == 'Un-Resolved')
                                                <span class="btn btn-danger btn-sm" style="font-size: 12px!important;">Un-Resolved </span>
                                                @elseif($complain->status == 'In-Process')
                                                <span class="btn btn-primary btn-sm">In-Progress</span>
                                                @elseif($complain->status == 'Closed')
                                                <span class="btn btn-success btn-sm">Closed</span>
                                                @endif
                                            <td>
                                                <a href="{{ route('view-admin-complains', $complain->id) }}" class="btn btn-success delete_complain" data-id="{{ $complain->id }}">
                                                    <i class="fa fa-eye"></i>
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