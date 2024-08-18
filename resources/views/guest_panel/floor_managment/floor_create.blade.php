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
                            <div class="basic-form">
                                <form action="{{ route('store-floor') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Floor Name</label>
                                            <input type="text" class="form-control" name="floor_name" placeholder="Enter floor name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Floor Number</label>
                                            <input type="number" class="form-control" name="floor_number" placeholder="Enter floor number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Number of Rooms</label>
                                            <input type="number" class="form-control" name="number_of_rooms" placeholder="Enter total number of rooms on this floor" required>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Floor Type</label>
                                            <select class="form-control" name="floor_type" required>
                                                <option value="" disabled selected>Select floor type</option>
                                                <option value="Residential">Residential</option>
                                                <option value="Commercial">Commercial</option>
                                                <option value="Mixed-Use">Mixed-Use</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Total Area (sq ft)</label>
                                            <input type="number" class="form-control" name="total_area_sq_ft" placeholder="Enter total area in square feet" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Floor Description</label>
                                            <textarea class="form-control" rows="6" name="floor_description" placeholder="Enter a detailed description of the floor"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Floor</button>
                                </form>

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