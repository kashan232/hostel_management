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
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Invoice</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('invoice-of-guests') }}">Manage Invoice</a></li>
                    <li><a href="{{ route('invoices-paid-guest') }}">Padi Invoice</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Complains</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('complain-form') }}">Register Complains</a></li>
                    <li><a href="{{ route('complains') }}">Complains</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('geust-notices') }}" aria-expanded="false">
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Notices</span>
                </a>
            </li>

        </ul>
    </div>
</div>