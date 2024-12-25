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
          <div class="pl-5 pr-5">
            @error('email')
            <h5 class="text-danger">{{ $message }}</h5>
            @enderror
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Manage Staff</h4>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>
                Add New
              </button>
              
            </div>

            <div class="card-body">


              <div class="table-responsive">
                <table id="example" class="display table" style="min-width: 845px">
                  <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $staff->username }}</td>
                      <td>{{ $staff->name }}</td>
                      <td>{{ $staff->email }}</td>
                      <td><span class="badge rounded-pill text-bg-info">Staff</span></td>
                      <td>
                        <a href="javascript:void(0)" class="btn btn-primary edit_staff"
                          data-id="{{ $staff->id }}"
                          data-name="{{ $staff->name }}"
                          data-username="{{ $staff->username }}"
                          data-email="{{ $staff->email }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>

                        <a href="{{ route('delete-staff',['id' => $staff->id ]) }}" class="btn btn-danger">
                          <i class="fa fa-trash"></i> Delete
                        </a>
                      </td>

                    </tr>
                    @endforeach
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Staff</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('store-staff') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="staffName" class="form-label">Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="staffName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="staffUsername" class="form-label">Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="staffUsername" name="username" required>
          </div>
          <div class="mb-3">
            <label for="staffEmail" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="staffEmail" name="email" required>


          </div>
          <div class="mb-3">
            <label for="staffRole" class="form-label">Role<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="staffEmail" name="usertype" value="Staff" readonly>
          </div>
          <div class="mb-3">
            <label for="staffPassword" class="form-label">Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="staffPassword" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editExampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit New Staff</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp">
          </div>
          {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(".edit_staff").click(function() {
    // alert($(this).data('name'));
    $("#name").val($(this).data('name'));
    $("#username").val($(this).data('username'));
    $("#email").val($(this).data('email'));
    $("#editExampleModal").modal("show");
  });

  $(document).ready(function() {
    // Attach a click event to the edit button
    $('.edit_staff').on('click', function() {
      var staffId = $(this).data('id');
      var staffName = $(this).data('name');
      var staffUsername = $(this).data('username');
      var staffEmail = $(this).data('email');

      // Set the values in the modal inputs
      $('#editExampleModal #name').val(staffName);
      $('#editExampleModal #username').val(staffUsername);
      $('#editExampleModal #email').val(staffEmail);

      // Store the staff ID for update purpose
      $('#editExampleModal').data('id', staffId);

      // Show the modal
      $('#editExampleModal').modal('show');
    });
  });


  $('#editExampleModal .btn-primary').on('click', function() {
    var staffId = $('#editExampleModal').data('id');
    var name = $('#editExampleModal #name').val();
    var username = $('#editExampleModal #username').val();
    var email = $('#editExampleModal #email').val();

    // Make an AJAX request to update the staff details
    $.ajax({
      url: '/staff-update/' + staffId, // Your route to update staff
      method: 'GET', // Use PUT or POST depending on your route
      data: {
        _token: '{{ csrf_token() }}', // Include CSRF token for security
        name: name,
        username: username,
        email: email
      },
      success: function(response) {
        if (response.success) {
          // Close the modal
          $('#editExampleModal').modal('hide');

          // Optionally, refresh the page or update the table row with new data
          location.reload(); // Refresh the page to see the updated data
        } else {
          alert('Something went wrong!');
        }
      },
      error: function(xhr) {
        console.error('Error:', xhr.responseText);
      }
    });
  });
</script>
@include('admin_panel.inlcude.footer_include')