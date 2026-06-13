<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</head>
<body>

@include('mainside')

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $grandTotal = 0;
    @endphp

    <div class="row">

        <!-- Billing -->
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4>Billing Details</h4>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Name</label>

                            <input type="text"
                                   id="customer_name"
                                   value="{{ Auth::user()->name }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email"
                                   id="customer_email"
                                   value="{{ Auth::user()->email }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Mobile</label>

                            <input type="text"
                                   id="customer_mobile"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Pincode</label>

                            <input type="text"
                                   class="form-control">
                        </div>

                        <div class="col-md-12">

                            <label>Address</label>

                            <textarea class="form-control"
                                      rows="4"></textarea>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Summary -->
        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4>Order Summary</h4>
                </div>

                <div class="card-body">

                    @foreach($cartItems as $item)

                        @php
                            $total = $item->product->price * $item->qty;
                            $grandTotal += $total;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                {{ $item->product->name }}
                                x {{ $item->qty }}
                            </span>

                            <span>
                                ₹{{ number_format($total,2) }}
                            </span>

                        </div>

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">

                        <strong>Total</strong>

                        <strong class="text-success">
                            ₹{{ number_format($grandTotal,2) }}
                        </strong>

                    </div>

                    <button id="rzp-button"
                            class="btn btn-success w-100 mt-3">

                        Pay ₹{{ number_format($grandTotal,2) }}

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@include('footer')

<script>

document.getElementById('rzp-button').onclick = function(e){

    var options = {

        key: "{{ $razorpayKey }}",

        amount: "{{ $grandTotal * 100 }}",

        currency: "INR",

        name: "Laravel Store",

        description: "Order Payment",

        handler: function (response) {

            alert(
                "Payment Successful\n\nPayment ID : "
                + response.razorpay_payment_id
            );

            window.location.href =
            "/payment-success?payment_id="
            + response.razorpay_payment_id;

        },

        prefill: {

            name:
            document.getElementById('customer_name').value,

            email:
            document.getElementById('customer_email').value,

            contact:
            document.getElementById('customer_mobile').value

        },

        theme: {
            color: "#198754"
        }

    };

    var rzp = new Razorpay(options);

    rzp.open();

    e.preventDefault();

}

</script>

</body>
</html>