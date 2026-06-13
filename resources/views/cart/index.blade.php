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

    <h2 class="mb-4">My Cart</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

        @php $grandTotal = 0; @endphp

        @foreach($cartItems as $item)

            @php
                $total = $item->product->price * $item->qty;
                $grandTotal += $total;
            @endphp

            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>₹{{ $item->product->price }}</td>
                <td>₹{{ $total }}</td>
            </tr>

        @endforeach

        </tbody>

    </table>

    <h4 class="text-end">
        Grand Total: ₹{{ $grandTotal }}
    </h4>

    <div class="text-end">
        <a href="{{ route('cart.index') }}"
           class="btn btn-success">

            Proceed To Checkout

        </a>
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