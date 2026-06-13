<!DOCTYPE html>
<html>
<head>
    <title>Event Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<!-- Navbar Start -->
@include('mainside')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- Events Section -->
<div class="container mt-5">

    <div class="text-center mb-4">
        <h2>Upcoming Events</h2>
    </div>

    <div class="row">

        @forelse($events as $event)

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                <img src="{{ asset('storage/'.$event->banner) }}"
                     class="card-img-top"
                     height="220"
                     style="object-fit:cover;">

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $event->title }}
                    </h5>

                    <p>
                        {{ Str::limit($event->description,100) }}
                    </p>

                    <p>
                        <i class="fa-solid fa-calendar"></i>
                        {{ $event->event_date }}
                    </p>

                    <p>
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $event->location }}
                    </p>

                </div>
<div class="card-footer bg-white">

    @auth
        <div class="row g-2">

            <div class="col-4">
                <a href="{{ route('event.details', $event->id) }}" class="btn btn-primary w-100">
                    View 
                </a>
            </div>

            <div class="col-4">
                <a href="{{ route('event.ticket', $event->id) }}" class="btn btn-success w-100">
                    QR Ticket
                </a>
            </div>

            <div class="col-4">
                <form action="{{ route('event.register', $event->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning w-100">
                        Register
                    </button>
                </form>
            </div>

        </div>
    @else
        <a href="{{ route('login') }}" class="btn btn-warning w-100">
            Login To View Details
        </a>
    @endauth

</div>

            </div>

        </div>

        @empty

        <div class="col-md-12">
            <div class="alert alert-info text-center">
                No Events Available
            </div>
        </div>

        @endforelse

    </div>

    <div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Our Products</h2>
        <p class="text-muted">Browse Approved Products</p>
    </div>

    <div class="row">

        @forelse($products as $product)

           <div class="col-md-4 mb-4">

    <div class="card shadow border-0 h-100">

        {{-- Main Image --}}
        @if($product->images->count())

            <img src="{{ asset('storage/'.$product->images->first()->image) }}"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">

        @else

            <img src="https://via.placeholder.com/400x250"
                 class="card-img-top">

        @endif

        <div class="card-body">

            <h5 class="fw-bold">
                {{ $product->name }}
            </h5>

            <p class="text-muted">
                {{ Str::limit($product->description, 100) }}
            </p>

            <h4 class="text-success mb-3">
                ₹ {{ number_format($product->price,2) }}
            </h4>

            {{-- Buttons --}}
            <div class="d-grid gap-2">

                <a href="{{ route('product.details', Str::slug($product->name)) }}"
                   class="btn btn-outline-primary">

                    <i class="fas fa-eye"></i>
                    View Details

                </a>

                @auth

                <form action="{{ route('cart.add',$product->id) }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="btn btn-success w-100">

                        <i class="fas fa-cart-plus"></i>
                        Add To Cart

                    </button>

                </form>

                @else

                <a href="{{ route('login') }}"
                   class="btn btn-danger">

                    <i class="fas fa-sign-in-alt"></i>
                    Login To Buy

                </a>

                @endauth

            </div>

        </div>

        {{-- Multiple Images Gallery --}}
        <div class="card-footer bg-white">

            <small class="text-muted d-block mb-2">
                More Images
            </small>

            <div class="d-flex flex-wrap gap-2">

                @foreach($product->images as $image)

                    <img src="{{ asset('storage/'.$image->image) }}"
                         width="60"
                         height="60"
                         class="rounded border shadow-sm"
                         style="object-fit:cover;">

                @endforeach

            </div>

        </div>

    </div>

</div>

        @empty

            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No Products Available
                </div>
            </div>

        @endforelse

    </div>

</div>

</div>

<!-- Footer -->
@include('footer')

</body>
</html>