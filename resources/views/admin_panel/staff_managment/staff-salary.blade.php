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
              <h4 class="card-title">Staff Salary</h4>
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
                      <th>Name</th>
                      <th>Year</th>
                      <th>Month</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>01</td>
                      <td>soban</td>
                      <td>2024</td>
                      <td>July</td>
                      <td>2024-7-21</td>
                      <td>15000</td>
                      <td><span class="badge rounded-pill text-bg-info">Paid</span></td>
                      <td>
                        <a href="javascript:void(0)" class="btn btn-primary edit_staff" data-name="soban" data-username="soban" data-email="sobanqureshi00@gmail.com">
                          <i class="fa fa-edit"></i>
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>02</td>
                      <td>Ali</td>
                      <td>2024</td>
                      <td>July</td>
                      <td>2024-7-21</td>
                      <td>20000</td>
                      <td><span class="badge rounded-pill text-bg-info">Unpaid</span></td>
                      <td>
                        <a href="javascript:void(0)" class="btn btn-primary edit_staff" data-name="Ali" data-username="Ali" data-email="Ali@gmail.com">
                          <i class="fa fa-edit"></i>
                          Edit
                        </a>
                      </td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Staff Salary</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select Staff<span class="text-danger">*</span></label>
            <select name="staff" id="staff" class="form-control">
              @foreach($staffs as $staff)
              <option value="{{ $staff->id }}"> {{ $staff->name }} </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Date<span class="text-danger">*</span></label>
            <input type="date" name="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select Year<span class="text-danger">*</span></label>
            <select name="year" id="year" class="form-control">
              <option value="">2024</option>
              <option value="">2023</option>
              <option value="">2022</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select Moth<span class="text-danger">*</span></label>
            <select name="month" id="month" class="form-control">
              <option value="">Select Month</option>
              <option value="">Jan</option>
              <option value="">February</option>
              <option value="">March</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Amount<span class="text-danger">*</span></label>
            <input type="text" name="amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control">
              <option value="">Paid</option>
              <option value="">Unpaid</option>
            </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Staff</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
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
</script>
@include('admin_panel.inlcude.footer_include')