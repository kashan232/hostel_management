@include('admin_panel.inlcude.header_include')
<div id="main-wrapper" class="wallet-open active">
    @include('admin_panel.inlcude.top_sidebar_include')
    @include('admin_panel.inlcude.navbar_include')
    @include('admin_panel.inlcude.sidebar_include')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Current Profile</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Hostel Name:</strong> {{ $profile->hostel_name }}</p>
                            <p><strong>Owner Name:</strong> {{ $profile->owner_name }}</p>
                            <p><strong>Owner Email:</strong> {{ $profile->owner_email }}</p>
                            <p><strong>Owner CNIC:</strong> {{ $profile->owner_cnic }}</p>
                            <p><strong>Owner Address:</strong> {{ $profile->owner_address }}</p>
                            <p><strong>Owner City:</strong> {{ $profile->owner_city }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hostel Profile</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success solid alert-square">
                                <strong>Success!</strong> {{ session('success') }}.
                            </div>
                            @endif
                            <div class="basic-form">
                                <form action="{{ route('admin-profile-updte') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Hostel Name</label>
                                        <input type="text" name="hostel_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        <input type="text" name="owner_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Owner Email</label>
                                        <input type="email" name="owner_email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Owner CNIC</label>
                                        <input type="text" name="owner_cnic" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Owner Address</label>
                                        <input type="text" name="owner_address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Owner City</label>
                                        <input type="text" name="owner_city" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-1 mb-1">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
           
            <!-- Display saved profile info -->

        </div>
    </div>

    @include('admin_panel.inlcude.copyright_include')
</div>

@include('admin_panel.inlcude.footer_include')