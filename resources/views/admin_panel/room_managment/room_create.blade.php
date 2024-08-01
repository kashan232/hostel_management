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
                            <h4 class="card-title">Create Rooms</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="/rooms/create" method="POST">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Floor Name</label>
                                            <select class="form-control" name="floor_id" required>
                                                <option value="" disabled selected>Select floor</option>
                                                <!-- Example options, replace with dynamic data -->
                                                <option value="1">Ground Floor</option>
                                                <option value="2">First Floor</option>
                                                <option value="3">Second Floor</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Room Number</label>
                                            <input type="text" class="form-control" name="room_number" placeholder="Enter room number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Room Type</label>
                                            <select class="form-control" name="room_type" required>
                                                <option value="" disabled selected>Select room type</option>
                                                <option value="Single">Single</option>
                                                <option value="Double">Double</option>
                                                <option value="Suite">Suite</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Number of Beds</label>
                                            <input type="number" class="form-control" name="number_of_beds" placeholder="Enter number of beds" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Room Size (sq ft)</label>
                                            <input type="number" class="form-control" name="room_size" placeholder="Enter room size in square feet" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Room Amenities</label>
                                            <textarea class="form-control" name="room_amenities" placeholder="List room amenities (e.g., AC, Wi-Fi, TV)"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Occupancy Status</label>
                                            <select class="form-control" name="occupancy_status" required>
                                                <option value="" disabled selected>Select occupancy status</option>
                                                <option value="Available">Available</option>
                                                <option value="Occupied">Occupied</option>
                                                <option value="Under Maintenance">Under Maintenance</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Room Description</label>
                                            <textarea class="form-control" name="room_description" placeholder="Enter a detailed description of the room"></textarea>
                                        </div>
                                    </div>
                                    <!-- Charges Section -->
                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Daily Charge (PKR)</label>
                                            <input type="number" class="form-control" name="daily_charge" placeholder="Enter daily charge" required>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Monthly Charge (PKR)</label>
                                            <input type="number" class="form-control" name="monthly_charge" placeholder="Enter monthly charge" required>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Yearly Charge (PKR)</label>
                                            <input type="number" class="form-control" name="yearly_charge" placeholder="Enter yearly charge" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Room</button>
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