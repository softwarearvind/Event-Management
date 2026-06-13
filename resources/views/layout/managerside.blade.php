    <div class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- Sidebar Menu -->
    <ul class="nav flex-column p-3">

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
        </li>

       <li class="nav-item mb-2">
        <a href="{{ route('event.index')}}" class="nav-link text-white">
        <i class="fa-solid fa-calendar-days"></i>
        Event
            </a>
        </li>

        <li class="nav-item mb-2">
        <a href="{{ route('product.index')}}" class="nav-link text-white">
        <i class="fa-solid fa-boxes-stacked"></i>
        Product
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-users"></i>
                Users
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-file-lines"></i>
                Reports
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-calendar-check"></i>
                Attendance
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-list-check"></i>
                Tasks
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-chart-line"></i>
                Performance
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-bell"></i>
                Notifications
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white">
                <i class="fa-solid fa-gear"></i>
                Settings
            </a>
        </li>

    </ul>

</div>
