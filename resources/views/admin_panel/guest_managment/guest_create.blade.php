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
                            <h4 class="card-title">Create Guest</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="/tenants/create" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" placeholder="Enter mobile number" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Upload CNIC Picture</label>
                                            <input type="file" class="form-control" name="cnic_pic" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Enter home address" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Type</label>
                                            <select class="form-control" name="id_type" required>
                                                <option value="" disabled selected>Select ID type</option>
                                                <option value="CNIC">CNIC</option>
                                                <option value="License">License</option>
                                                <option value="Passport">Passport</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">ID Number</label>
                                            <input type="text" class="form-control" name="id_number" placeholder="Enter ID number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Profession</label>
                                            <input type="text" class="form-control" name="profession" placeholder="Enter profession" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Work Address</label>
                                            <textarea class="form-control" name="work_address" placeholder="Enter work address" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Emergency Contact Person</label>
                                            <input type="text" class="form-control" name="emergency_person" placeholder="Enter emergency contact person's name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Emergency Contact Number</label>
                                            <input type="text" class="form-control" name="emergency_number" placeholder="Enter emergency contact number" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="" disabled selected>Select status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Select Floor</label>
                                            <select class="form-control" name="floor_id" required>
                                                <option value="" disabled selected>Select floor</option>
                                                <!-- Example options, replace with dynamic data -->
                                                <option value="1">Ground Floor</option>
                                                <option value="2">First Floor</option>
                                                <option value="3">Second Floor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Select Room</label>
                                            <select class="form-control" name="room_id" required>
                                                <option value="" disabled selected>Select room</option>
                                                <!-- Example options, replace with dynamic data -->
                                                <option value="101">Room 101</option>
                                                <option value="102">Room 102</option>
                                                <option value="201">Room 201</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Lease Period (From)</label>
                                            <input type="date" class="form-control" name="lease_from" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Lease Period (To)</label>
                                            <input type="date" class="form-control" name="lease_to" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Extra Notes</label>
                                            <textarea class="form-control" name="extra_notes" placeholder="Any additional information"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register Tenant</button>
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