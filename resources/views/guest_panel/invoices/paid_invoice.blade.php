@include('guest_panel.inlcude.header_include')
<style>
    .receipt-content {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    @media print {
        .receipt-content {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            box-shadow: none;
        }
    }
</style>
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

    <!-- Modal -->

    <!-- Hidden Receipt Template -->
<div id="receipt-template" style="display: none;">
    @foreach($paidInvoices as $invoice)
    <div id="receipt-{{ $invoice->id }}" class="receipt" style="
        width: 80mm; 
        margin: 0 auto; 
        padding: 10px; 
        border: 1px solid #000; 
        box-shadow: 0 0 5px rgba(0,0,0,0.1); 
        font-family: 'Poppins', sans-serif; 
        text-align: center;
        position: relative;
        background: #fff;
    ">
        <!-- Add your logo here -->
        <!-- <img src="path/to/your/logo.png" alt="Logo" style="width: 120px; margin-bottom: 10px; display: block; margin-left: auto; margin-right: auto;"> -->
        <!-- Receipt Header -->
        <h2 style="margin: 10px 20px; font-size: 18px; font-weight: bold; text-align:center">Receipt</h2>
        
        <!-- Invoice Details -->
        <div style="margin: 10px 20px;">
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Invoice ID:</strong> <span style="text-align: right; float: right;">{{ $invoice->id }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Guest Name:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->name }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Guest Email:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->email }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Payment Method:</strong> <span style="text-align: right; float: right;">{{ ucfirst($invoice->payment_method) }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Payment Date:</strong> <span style="text-align: right; float: right;">{{ \Carbon\Carbon::parse($invoice->payment_date)->format('d-m-Y') }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Booking Date:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->booking_date }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Lease Period:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->lease_from }} to {{ $invoice->guest->lease_to }}</span></p>
        </div>

        <!-- Amount Details -->
        <div style="margin: 10px 20px; border-top: 1px solid #000; border-bottom: 1px solid #000; padding: 10px;">
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Amount Paid:</strong> <span style="text-align: right; float: right;">{{ $invoice->amount_paid }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Room Charges:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->room_charges }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Total Charges:</strong> <span style="text-align: right; float: right;">{{ $invoice->guest->total_charges }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Total Service Charges:</strong> <span style="text-align: right; float: right;">{{ $invoice->total_service_charges }}</span></p>
            <p style="margin: 5px 0; font-size: 14px; text-align: left;"><strong>Total Payable Amount:</strong> <span style="text-align: right; float: right;">{{ $invoice->total_payable }}</span></p>
        </div>

        <!-- Footer -->
        <div style="margin: 10px 0; font-size: 12px; text-align: center;">
            <hr style="border: 0; border-top: 1px dashed #000; margin: 10px 0;">
            <p style="margin: 5px 0;">Powered by Kashan Shaikh</p>
            <p style="margin: 5px 0;">Contact: 03173859647</p>
        </div>
    </div>
    @endforeach
</div>





    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Guest Paid Invoice</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Guest Name</th>
                                            <th>Guest Email</th>
                                            <th>Payment Method</th>
                                            <th>Payment Date</th>
                                            <th>Booking Date</th>
                                            <th>Lease Period</th>
                                            <th>Amount Paid</th>
                                            <th>Room Charges</th>
                                            <th>Total Charges</th>
                                            <th>Total Service Charges</th> <!-- New Column -->
                                            <th>Total Payable Amount</th> <!-- New Column -->
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paidInvoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->guest->name }}</td>
                                            <td>{{ $invoice->guest->email }}</td>
                                            <td>{{ ucfirst($invoice->payment_method) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($invoice->payment_date)->format('d-m-Y') }}</td>
                                            <td>{{ $invoice->guest->booking_date }}</td>
                                            <td>{{ $invoice->guest->lease_from }} to {{ $invoice->guest->lease_to }}</td>
                                            <td>{{ $invoice->amount_paid }}</td>
                                            <td>{{ $invoice->guest->room_charges }}</td>
                                            <td>{{ $invoice->guest->total_charges }}</td>
                                            <td>{{ $invoice->total_service_charges }}</td> <!-- Display Total Service Charges -->
                                            <td>{{ $invoice->total_payable }}</td> <!-- Display Total Payable Amount -->
                                            <td>
                                                <span class="badge bg-success">{{ $invoice->guest->status }}</span>
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
<script>
    function printReceipt(invoiceId) {
        // Get the receipt content
        var receiptContent = document.getElementById('receipt-' + invoiceId).innerHTML;

        // Create a new window
        var printWindow = window.open('', '', 'height=600,width=800');

        // Add HTML content to the new window
        printWindow.document.write('<html><head><title>Receipt</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");');
        printWindow.document.write('@media print {');
        printWindow.document.write('body { margin: 0; padding: 0; }');
        printWindow.document.write('.receipt { width: 80mm; margin: 0 auto; padding: 10px; font-size: 12px; text-align: center; }');
        printWindow.document.write('img { max-width: 100%; height: auto; }');
        printWindow.document.write('hr { border: 0; border-top: 1px dashed #000; margin: 10px 0; }');
        printWindow.document.write('p { margin: 5px 0; }');
        printWindow.document.write('h2 { font-size: 18px; font-weight: bold; }');
        printWindow.document.write('}</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(receiptContent);
        printWindow.document.write('</body></html>');

        // Close the document and print
        printWindow.document.close();
        printWindow.document.focus();
        printWindow.print();
    }
</script>