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
                            <h4 class="card-title">Manage Expense</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table">
                                    <thead>
                                        <tr>
                                            <th>SNO</th>
                                            <th>Name</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Expenses as $Expense)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Expense->name }}</td>
                                            <td>{{ $Expense->year }}</td>
                                            <td>{{ $Expense->month }}</td>
                                            <td>{{ $Expense->Amount }}</td>
                                            <td>{{ $Expense->description }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary edit_expense"
                                                    data-id="{{ $Expense->id }}"
                                                    data-name="{{ $Expense->name }}"
                                                    data-year="{{ $Expense->year }}"
                                                    data-month="{{ $Expense->month }}"
                                                    data-amount="{{ $Expense->Amount }}"
                                                    data-description="{{ $Expense->description }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="{{ route('delete-expense',['id' => $Expense->id ]) }}" class="btn btn-danger">
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


<!-- Edit Expense Modal -->
<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpenseModalLabel">Edit Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editExpenseForm">
                    <input type="hidden" name="expense_id" id="editExpenseId">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="editExpenseName" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Year</label>
                            <input type="text" class="form-control" name="year" id="editExpenseYear" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Month</label>
                            <input type="text" class="form-control" name="month" id="editExpenseMonth" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Amount</label>
                            <input type="text" class="form-control" name="Amount" id="editExpenseAmount" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="editExpenseDescription" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
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
@include('admin_panel.inlcude.footer_include')

<script>
    document.querySelectorAll('.edit_expense').forEach(button => {
        button.addEventListener('click', function() {
            var expenseId = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');
            var year = this.getAttribute('data-year');
            var month = this.getAttribute('data-month');
            var amount = this.getAttribute('data-amount');
            var description = this.getAttribute('data-description');

            // Populate the modal with the existing data
            document.getElementById('editExpenseId').value = expenseId;
            document.getElementById('editExpenseName').value = name;
            document.getElementById('editExpenseYear').value = year;
            document.getElementById('editExpenseMonth').value = month;
            document.getElementById('editExpenseAmount').value = amount;
            document.getElementById('editExpenseDescription').value = description;

            // Show the modal
            var editModal = new bootstrap.Modal(document.getElementById('editExpenseModal'));
            editModal.show();
        });
    });

    document.getElementById('editExpenseForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form data
        var formData = new FormData(this);

        // Submit the form using AJAX
        fetch('/update-expense', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Handle success (e.g., reload the page or update the table row)
                    location.reload();
                } else {
                    // Handle errors (if any)
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>