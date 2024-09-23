<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('home') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">home</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">person</i>
                    <span class="nav-text">Staff</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('staff') }}">Staff</a></li>
                    <li><a href="{{ route('staff-salary') }}">Staff Salary</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">lan</i>
                    <span class="nav-text">Service</span>
                    
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('services') }}">Manage Service</a></li>
                    <li><a href="{{ route('services-create') }}">Add Service</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">apartment</i>

                    <span class="nav-text">Floors</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('floors') }}">Manage Floors</a></li>
                    <li><a href="{{ route('floor-create') }}">Add Floors</a></li>

                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">real_estate_agent</i>
                    <span class="nav-text">Rooms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('rooms') }}">Manage Rooms</a></li>
                    <li><a href="{{ route('room-create') }}">Add Rooms</a></li>

                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">bed</i>
                    <span class="nav-text">Seat Setup</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('seat-setup') }}">Manage Seats</a></li>
                    <li><a href="{{ route('seat-setup-create') }}">Add Seats</a></li>

                </ul>
            </li>


            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">person_search</i>
                    <span class="nav-text">Guests</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('guests') }}">Manage Guests</a></li>
                    <li><a href="{{ route('guest-create') }}">Add Guests</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">receipt_long</i>
                    <span class="nav-text">Invoice</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('guest-invoice') }}">Manage Invoice</a></li>
                    <li><a href="{{ route('invoices-paid') }}">Paid Invoice</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin-complains') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">notifications</i>
                    <span class="nav-text">Complains</span>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">mark_email_unread</i>
                    <span class="nav-text">Notices</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('notices') }}">Manage Notices</a></li>
                    <li><a href="{{ route('notices-create') }}">Add Notices</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">payments</i>
                    <span class="nav-text">Expense</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('expense') }}">Manage Expense</a></li>
                    <li><a href="{{ route('expense-create') }}">Add Expense</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">warehouse</i>
                    <span class="nav-text">Inventory</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('inventory') }}">Manage Inventory</a></li>
                    <li><a href="{{ route('inventory-create') }}">Add Inventory</a></li>
                </ul>
            </li>



        </ul>
    </div>
</div>