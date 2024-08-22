@include('guest_panel.inlcude.header_include')
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
    @include('guest_panel.inlcude.top_sidebar_include')

    <!--**********************************
            Nav header end
        ***********************************-->
    <!--**********************************
            Header start
        ***********************************-->
    @include('guest_panel.inlcude.navbar_include')
    <!--**********************************
            Header end 
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    @include('guest_panel.inlcude.sidebar_include')
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
                            <div class="basic-form">
                                <form action="{{ route('store-complain') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Complaint Title -->
                                        <div class="mb-3 col-md-12">
                                            <label for="complaint-title" class="form-label">Complaint Title</label>
                                            <input type="text" name="complaint_title" id="complaint-title" class="form-control" placeholder="Enter the title of your complaint" required>
                                        </div>

                                        <!-- Complaint Date -->
                                        <div class="mb-3 col-md-4">
                                            <label for="complaint-date" class="form-label">Complaint Date</label>
                                            <input type="date" name="complaint_date" id="complaint-date" class="form-control" required>
                                        </div>

                                        <!-- Complaint Category -->
                                        <div class="mb-3 col-md-4">
                                            <label for="complaint-category" class="form-label">Complain Type</label>
                                            <input type="text" name="complaint_type" id="complaint-type" class="form-control" required>
                                        </div>
                                         <!-- Attach Picture -->
                                         <div class="mb-3 col-md-4">
                                            <label for="complaint-picture" class="form-label">Attach Picture</label>
                                            <input type="file" name="complaint_pic" id="complaint-picture" class="form-control">
                                        </div>

                                        <!-- Complaint Description -->
                                        <div class="mb-3 col-md-12">
                                            <label for="complaint-description" class="form-label">Complaint Description</label>
                                            <textarea name="complaint_description" id="complaint-description" class="form-control" rows="4" placeholder="Describe your complaint in detail" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Complaint</button>
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
    @include('guest_panel.inlcude.copyright_include')

</div>
<!--**********************************
        Scripts
    ***********************************-->
@include('guest_panel.inlcude.footer_include')