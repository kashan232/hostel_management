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