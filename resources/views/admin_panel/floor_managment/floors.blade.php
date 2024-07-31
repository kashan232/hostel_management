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
                                            <th>Floor Name</th>
                                            <th>Floor Number</th>
                                            <th>Number of Rooms</th>
                                            <th>Floor Type</th>
                                            <th>Total Area (sq ft)</th>
                                            <th>Amenities</th>
                                            <th>Accessibility Features</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ground Floor</td>
                                            <td>0</td>
                                            <td>10</td>
                                            <td>Residential</td>
                                            <td>1200</td>
                                            <td>Wi-Fi, Common Area</td>
                                            <td>Elevator Access</td>
                                        </tr>
                                        <tr>
                                            <td>First Floor</td>
                                            <td>1</td>
                                            <td>15</td>
                                            <td>Commercial</td>
                                            <td>1500</td>
                                            <td>Conference Room, Wi-Fi</td>
                                            <td>Ramps, Elevator Access</td>
                                        </tr>
                                        <tr>
                                            <td>Second Floor</td>
                                            <td>2</td>
                                            <td>12</td>
                                            <td>Residential</td>
                                            <td>1300</td>
                                            <td>Lounge, Wi-Fi</td>
                                            <td>Elevator Access</td>
                                        </tr>
                                        <tr>
                                            <td>Third Floor</td>
                                            <td>3</td>
                                            <td>8</td>
                                            <td>Mixed-Use</td>
                                            <td>1600</td>
                                            <td>Gym, Wi-Fi</td>
                                            <td>Elevator Access</td>
                                        </tr>
                                        <tr>
                                            <td>Fourth Floor</td>
                                            <td>4</td>
                                            <td>20</td>
                                            <td>Commercial</td>
                                            <td>2000</td>
                                            <td>Meeting Rooms, Wi-Fi</td>
                                            <td>Ramps, Elevator Access</td>
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