@include('admin_panel.inlcude.header_include')
<div id="main-wrapper" class="wallet-open active">
    @include('admin_panel.inlcude.top_sidebar_include')
    @include('admin_panel.inlcude.navbar_include')
    @include('admin_panel.inlcude.sidebar_include')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Change Password</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success solid alert-square">
                                <strong>Success!</strong> {{ session('success') }}.
                            </div>
                            @endif

                            @if (session()->has('error'))
                            <div class="alert alert-danger solid alert-square">
                                <strong>Error!</strong> {{ session('error') }}.
                            </div>
                            @endif
                            <div class="basic-form">
                                <form action="{{ route('updte-change-Password') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Old Password</label>
                                            <div class="input-group">
                                                <input type="password" name="old_password" class="form-control" required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="new_password" class="form-control" required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Retype New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="retype_new_password" class="form-control" required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleRetypeNewPassword">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin_panel.inlcude.copyright_include')
</div>

@include('admin_panel.inlcude.footer_include')