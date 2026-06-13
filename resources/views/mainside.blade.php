<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/">
            <i class="fa-solid fa-calendar-days"></i>
            Event Management
        </a>

        <div class="ms-auto d-flex align-items-center">

            @auth

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}"
                   class="text-white position-relative me-4">

                    <i class="fas fa-shopping-cart fs-4"></i>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ \App\Models\Cart::where('user_id', auth()->id())->sum('qty') }}
                    </span>

                </a>

            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-warning">
                    Register
                </a>
            @else
                <span class="text-white me-3">
                    Welcome, {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">
                        Logout
                    </button>
                </form>
            @endguest

        </div>

    </div>
</nav>
<!-- Navbar End -->

<!-- Hero Section -->
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <h1>Welcome To Event Management System</h1>
        <p class="lead">Discover Upcoming Events Around You</p>
    </div>
</section>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif