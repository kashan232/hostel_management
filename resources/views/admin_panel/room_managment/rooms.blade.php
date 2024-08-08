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
                                            <th>Room Number</th>
                                            <th>Floor Name</th>
                                            <th>Room Type</th>
                                            <th>Number of Beds</th>
                                            <th>Room Size (sq ft)</th>
                                            <th>Amenities</th>
                                            <th>Occupancy Status</th>
                                            <th>Description</th>
                                            <th>Daily Charge (PKR)</th>
                                            <th>Monthly Charge (PKR)</th>
                                            <th>Yearly Charge (PKR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Rooms as $Room)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Room->room_number }}</td>
                                            <td>{{ $Room->floor_name }}</td>
                                            <td>{{ $Room->room_type }}</td>
                                            <td>{{ $Room->number_of_beds }}</td>
                                            <td>{{ $Room->room_size }}</td>
                                            <td>{{ $Room->room_amenities }}</td>
                                            <td>{{ $Room->occupancy_status }}</td>
                                            <td>{{ $Room->room_description }}</td>
                                            <td>{{ $Room->daily_charge }}</td>
                                            <td>{{ $Room->monthly_charge }}</td>
                                            <td>{{ $Room->yearly_charge }}</td>
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