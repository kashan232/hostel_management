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
                                            <th>Room Number</th>
                                            <th>Floor Name</th>
                                            <th>Room Type</th>
                                            <th>Number of Beds</th>
                                            <th>Room Size (sq ft)</th>
                                            <th>Amenities</th>
                                            <th>Occupancy Status</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>101</td>
                                            <td>Ground Floor</td>
                                            <td>Single</td>
                                            <td>1</td>
                                            <td>150</td>
                                            <td>AC, Wi-Fi</td>
                                            <td>Available</td>
                                            <td>Spacious single room with a nice view.</td>
                                        </tr>
                                        <tr>
                                            <td>102</td>
                                            <td>First Floor</td>
                                            <td>Double</td>
                                            <td>2</td>
                                            <td>200</td>
                                            <td>AC, Wi-Fi, TV</td>
                                            <td>Occupied</td>
                                            <td>Cozy double room, perfect for two guests.</td>
                                        </tr>
                                        <tr>
                                            <td>201</td>
                                            <td>Second Floor</td>
                                            <td>Suite</td>
                                            <td>3</td>
                                            <td>350</td>
                                            <td>AC, Wi-Fi, TV, Mini Bar</td>
                                            <td>Available</td>
                                            <td>Luxurious suite with a living area.</td>
                                        </tr>
                                        <tr>
                                            <td>202</td>
                                            <td>Second Floor</td>
                                            <td>Single</td>
                                            <td>1</td>
                                            <td>150</td>
                                            <td>AC, Wi-Fi</td>
                                            <td>Under Maintenance</td>
                                            <td>Single room currently under renovation.</td>
                                        </tr>
                                        <tr>
                                            <td>301</td>
                                            <td>Third Floor</td>
                                            <td>Double</td>
                                            <td>2</td>
                                            <td>220</td>
                                            <td>AC, Wi-Fi, TV, Balcony</td>
                                            <td>Occupied</td>
                                            <td>Comfortable double room with a balcony.</td>
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