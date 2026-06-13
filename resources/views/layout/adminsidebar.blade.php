

<div class="sidebar text-white">

    <div class="text-center p-4 border-bottom">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
             width="90"
             class="rounded-circle">

        <h5 class="mt-3">
            {{ Auth::user()->name }}
        </h5>

        <span class="badge bg-danger">
            Super Admin
        </span>

    </div>

    <ul class="nav flex-column p-3">

        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-gauge"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('users.index')}}" class="nav-link">
                <i class="fas fa-users"></i>
                Users Management
            </a>
        </li>


        <li>
            <a href="{{ route('roles.index')}}" class="nav-link">
                <i class="fas fa-shield-halved"></i>
                Roles & Permissions
            </a>
        </li>

        <li>
    <a href="{{ route('admin.events')}}" class="nav-link">
        <i class="fas fa-check-circle"></i>
            Approved Events
        </a>
    </li>

    <li>
    <a href="{{ route('product.approved')}}" class="nav-link">
        <i class="fas fa-check-circle"></i>
            Approved Product
        </a>
    </li>


        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-chart-column"></i>
                Reports
            </a>
        </li>

        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-calendar-check"></i>
                Attendance
            </a>
        </li>

        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-box"></i>
                Products
            </a>
        </li>

        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-bell"></i>
                Notifications
            </a>
        </li>

        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-gear"></i>
                Settings
            </a>
        </li>

        <li class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn btn-danger w-100">
                    Logout
                </button>
            </form>
        </li>

    </ul>


   

</div>