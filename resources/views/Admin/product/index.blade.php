<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    @include('layout.link')

     <style>

        body{
            margin:0;
            background:#f4f6f9;
            overflow-x:hidden;
        }

        .sidebar{
            width:280px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#212529;
            overflow-y:auto;
        }

        .main-content{
            margin-left:280px;
            padding:20px;
        }

        .nav-link{
            color:white !important;
            border-radius:10px;
            margin-bottom:5px;
        }

        .nav-link:hover{
            background:#0d6efd;
        }

        .card{
            border:none;
            border-radius:15px;
        }

    </style>

</head>
<body>

@include('layout.adminsidebar')




<div class="main-content">

    <!-- Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">
                <i class="fas fa-user-shield text-primary"></i>
                Admin Dashboard
            </h3>
            <small class="text-muted">
                Product Approval Management
            </small>
        </div>

        <div>
            Welcome,
            <strong class="text-primary">
                {{ Auth::user()->name }}
            </strong>
        </div>
    </div>

   
    <!-- Product List -->
    <div class="row">

        @forelse($products as $product)

        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">

                <div class="card-body">

                    <div class="text-center mb-3">

                       @if($product->images->count())
                        <img src="{{ asset('storage/'.$product->images->first()->image) }}"
                             class="img-fluid rounded"
                             style="height:200px;width:100%;object-fit:cover;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}"
                             class="img-fluid rounded"
                             style="height:200px;width:100%;object-fit:cover;">
                    @endif

                    </div>

                    <h5 class="product-name">
                        {{ $product->name }}
                    </h5>

                    <p class="text-muted mb-2">
                        {{ Str::limit($product->description, 80) }}
                    </p>

                    <h6 class="text-success">
                        ₹ {{ number_format($product->price,2) }}
                    </h6>

                    <p>
                        <span class="badge bg-warning text-dark">
                            Pending Approval
                        </span>
                    </p>

                    <div class="d-flex justify-content-between">

                        <form action="{{ route('admin.approve',$product->id) }}" method="POST" class="btn-action">
                            @csrf
                            <button class="btn btn-success w-100">
                                <i class="fas fa-check"></i>
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.reject',$product->id) }}" method="POST" class="btn-action">
                            @csrf
                            <button class="btn btn-danger w-100">
                                <i class="fas fa-times"></i>
                                Reject
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-box-open"></i>
                No Pending Products Found
            </div>
        </div>

        @endforelse

    </div>

</div>

</body>
</html>