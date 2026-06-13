<!DOCTYPE html>
<html>
<head>
    <title>Datals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

 
</head>
<body>
  @include('mainside')

  @if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

  <div class="container py-5">

    <div class="row g-5">

        <!-- Product Images -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <!-- Main Image -->
                    <img id="mainImage"
                         src="{{ asset('storage/'.$product->images->first()->image) }}"
                         class="img-fluid rounded w-100"
                         style="height:500px;object-fit:cover;">

                    <!-- Thumbnail Images -->
                    <div class="d-flex mt-3 flex-wrap gap-2">

                        @foreach($product->images as $image)

                            <img src="{{ asset('storage/'.$image->image) }}"
                                 class="border rounded shadow-sm thumb-image"
                                 width="90"
                                 height="90"
                                 style="cursor:pointer;object-fit:cover;">

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

        <!-- Product Details -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <span class="badge bg-success mb-3">
                        In Stock
                    </span>

                    <h2 class="fw-bold mb-3">
                        {{ $product->name }}
                    </h2>

                    <h3 class="text-success fw-bold mb-4">
                        ₹ {{ number_format($product->price,2) }}
                    </h3>

                    <hr>

                    <h5>Description</h5>

                    <p class="text-muted">
                        {{ $product->description }}
                    </p>

                    <hr>

                

                    @auth

                    <form action="{{ route('cart.add',$product->id) }}"
                          method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-2">

                                <input type="number"
                                       name="qty"
                                       value="1"
                                       min="1"
                                       class="form-control">

                            </div>

                            <div class="col-md-8">

                                <button class="btn btn-success w-100">

                                    <i class="fas fa-cart-plus"></i>
                                    Add To Cart

                                </button>

                            </div>

                        </div>

                    </form>

                    @else

                    <a href="{{ route('login') }}"
                       class="btn btn-danger w-100">

                        Login To Buy

                    </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</div>

@include('footer')
</body>

<script>

document.querySelectorAll('.thumb-image').forEach(function(img){

    img.addEventListener('click', function(){

        document.getElementById('mainImage').src = this.src;

    });

});

</script>
</html>