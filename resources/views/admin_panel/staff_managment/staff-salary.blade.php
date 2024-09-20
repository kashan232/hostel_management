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
                    @foreach($salaries as $salary)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $salary->staff }}</td>
                      <td>{{ $salary->year }}</td>
                      <td>{{ $salary->month }}</td>
                      <td>{{ $salary->date }}</td>
                      <td>{{ $salary->amount }}</td>
                      <td>
                        @if($salary->status == 'Paid')
                        <span class="badge rounded-pill text-bg-info">Paid</span>
                        @else
                        <span class="badge rounded-pill text-bg-danger">Unpaid</span>
                        @endif
                      </td>
                      <td>
                        <a href="javascript:void(0)"
                          class="btn btn-primary edit_staff"
                          data-id="{{ $salary->id }}"
                          data-staff="{{ $salary->staff }}"
                          data-year="{{ $salary->year }}"
                          data-month="{{ $salary->month }}"
                          data-date="{{ $salary->date }}"
                          data-amount="{{ $salary->amount }}"
                          data-status="{{ $salary->status }}">
                          <i class="fa fa-edit"></i>
                          Edit
                        </a>

                        <a href="{{ route('delete-staff-salary',['id' => $salary->id ]) }}" class="btn btn-danger">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Staff Salary</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('store-staff-salary') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select Staff<span class="text-danger">*</span></label>
            <select name="staff" id="staff" class="form-control">
              @foreach($staffs as $staff)
              <option value="{{ $staff->name }}"> {{ $staff->name }} </option>
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
              <option value="2024">2024</option>
              <option value="2023">2023</option>
              <option value="2022">2022</option>
              <option value="2021">2021</option>
              <option value="2020">2020</option>
              <option value="2019">2019</option>
              <option value="2018">2018</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
            </select>

          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select Moth<span class="text-danger">*</span></label>
            <select name="month" id="month" class="form-control">
              <option value="">Select Month</option>
              <option value="January">January</option>
              <option value="February">February</option>
              <option value="March">March</option>
              <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
              <option value="September">September</option>
              <option value="October">October</option>
              <option value="November">November</option>
              <option value="December">December</option>
            </select>

          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Amount<span class="text-danger">*</span></label>
            <input type="text" name="amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control">
              <option value="Paid">Paid</option>
              <option value="Unpaid">Unpaid</option>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Staff Salary</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editStaffSalaryForm">
          @csrf <!-- Use this for updating data -->
          <!-- Hidden input to store ID -->
          <input type="hidden" name="id" id="edit_id">

          <div class="mb-3">
            <label for="edit_staff" class="form-label">Select Staff<span class="text-danger">*</span></label>
            <select name="staff" id="edit_staff" class="form-control">
              @foreach($staffs as $staff)
              <option value="{{ $staff->name }}"> {{ $staff->name }} </option>
              @endforeach
            </select>
          </div>

          <!-- Year dropdown -->
          <div class="mb-3">
            <label for="edit_year" class="form-label">Select Year<span class="text-danger">*</span></label>
            <select name="year" id="edit_year" class="form-control">
              @for($i = date('Y'); $i >= 2000; $i--)
              <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>

          <!-- Month dropdown -->
          <div class="mb-3">
            <label for="edit_month" class="form-label">Select Month<span class="text-danger">*</span></label>
            <select name="month" id="edit_month" class="form-control">
              @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
              <option value="{{ $month }}">{{ $month }}</option>
              @endforeach
            </select>
          </div>


          <div class="mb-3">
            <label for="edit_date" class="form-label">Date<span class="text-danger">*</span></label>
            <input type="date" name="date" id="edit_date" class="form-control">
          </div>

          <div class="mb-3">
            <label for="edit_amount" class="form-label">Amount<span class="text-danger">*</span></label>
            <input type="text" name="amount" id="edit_amount" class="form-control">
          </div>

          <div class="mb-3">
            <label for="edit_status" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" id="edit_status" class="form-control">
              <option value="Paid">Paid</option>
              <option value="Unpaid">Unpaid</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
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
    // Get data attributes from the clicked button
    var id = $(this).data('id');
    var staff = $(this).data('staff');
    var year = $(this).data('year');
    var month = $(this).data('month');
    var date = $(this).data('date');
    var amount = $(this).data('amount');
    var status = $(this).data('status');

    // Set the values in the modal's input fields
    $("#edit_id").val(id); // Hidden input to store ID for updating
    $("#edit_staff").val(staff);
    $("#edit_year").val(year); // Set the selected year
    $("#edit_month").val(month); // Set the selected month
    $("#edit_date").val(date);
    $("#edit_amount").val(amount);
    $("#edit_status").val(status);

    // Show the modal
    $("#editExampleModal").modal("show");
  });

  // Submit the form using AJAX to update the data
  $("#editStaffSalaryForm").submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize(); // Serialize form data for AJAX

    $.ajax({
      url: "{{ route('update-staff-salary') }}", // Update route
      method: "GET",
      data: formData,
      success: function(response) {
        if (response.success) {
          alert("Salary updated successfully!");
          location.reload(); // Reload the page to reflect the changes
        } else {
          alert("Error updating salary.");
        }
      },
      error: function() {
        alert("An error occurred.");
      }
    });
  });
</script>

@include('admin_panel.inlcude.footer_include')