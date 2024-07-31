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
                    <span class="nav-text">Floors</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('floors') }}">Manage Floors</a></li>
                    <li><a href="{{ route('floor-create') }}">Add Floors</a></li>

                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Rooms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('rooms') }}">Manage Rooms</a></li>
                    <li><a href="{{ route('room-create') }}">Add Rooms</a></li>

                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Guests</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">Manage Guests</a></li>
                    <li><a href="#">Add Guests</a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>