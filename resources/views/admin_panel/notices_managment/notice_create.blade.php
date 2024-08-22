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
                            <h4 class="card-title">Create Notice</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('store-notices') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Notice Title -->
                                        <div class="mb-3 col-md-12">
                                            <label for="notice-title" class="form-label">Notice Title</label>
                                            <input type="text" name="title" id="notice-title" class="form-control" placeholder="Enter the title of the notice" required>
                                        </div>

                                        <!-- Notice Date -->
                                        <div class="mb-3 col-md-6">
                                            <label for="notice-date" class="form-label">Notice Date</label>
                                            <input type="date" name="notice_date" id="notice-date" class="form-control" required>
                                        </div>

                                        <!-- Expiry Date -->
                                        <div class="mb-3 col-md-6">
                                            <label for="expiry-date" class="form-label">Expiry Date</label>
                                            <input type="date" name="expiry_date" id="expiry-date" class="form-control">
                                        </div>

                                        <!-- Notice Description -->
                                        <div class="mb-3 col-md-12">
                                            <label for="notice-description" class="form-label">Notice Description</label>
                                            <textarea name="description" id="notice-description" class="form-control" rows="4" placeholder="Enter the notice details here" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Notice</button>
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