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
                            <h4 class="card-title">Create Inventory</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('store-inventory') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name name" required>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="Enter Price" required>
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Qunty</label>
                                            <input type="text" class="form-control" name="qunty" placeholder="Enter Qunty" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Inventory</button>
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