<!DOCTYPE html>
<html>
<head>
    @include('layout.link')
    <title>Manager Dashboard</title>
</head>
<style>
body{
    margin:0;
    padding:0;
    overflow-x:hidden;
    background:#f4f6f9;
}

.sidebar{
    width:280px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    overflow-y:auto;
    z-index:1000;
}

.main-content{
    margin-left:280px;
    padding:20px;
    width:calc(100% - 280px);
}

.nav-link{
    border-radius:8px;
    transition:.3s;
}

.nav-link:hover{
    background:#0d6efd;
    color:#fff !important;
}

.card{
    border:none;
    border-radius:15px;
}

.chart-card{
    height:400px;
}
</style>
<body>

<!-- Sidebar -->
<div class="sidebar bg-dark text-white shadow">

    <!-- User Profile -->
    <div class="p-4 border-bottom text-center">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
             width="80"
             class="rounded-circle border border-3 border-light">

        <h5 class="mt-3 mb-0">
            {{ Auth::user()->name }}
        </h5>

        <small class="text-warning">
            Manager
        </small>

    @include('layout.managerside')
<!-- Main Content -->
<div class="main-content">

    <h2 class="mb-4">
        Welcome {{ Auth::user()->name }}
    </h2>

<div class="container">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0">My Products</h3>

        <!-- Add Product Button -->
        <a href="{{ url('/product/create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Product
        </a>

    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Product Table -->
    <div class="card shadow">

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $key => $product)
                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>{{ $product->name }}</td>

                            <td>₹{{ $product->price }}</td>

                            <!-- Status Badge -->
                            <td>
                                @if($product->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($product->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>

                            <!-- Images -->
                            <td>
                                @foreach($product->images as $img)
                                    <img src="{{ asset('storage/'.$img->image) }}"
                                         width="50"
                                         height="50"
                                         class="rounded border">
                                @endforeach
                            </td>

                            <!-- Actions -->
                            <td>
                                <a href=""
                                   class="btn btn-sm btn-info">
                                    Edit
                                </a>

                                <a href=""
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>
                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Products Found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>




</div>



</body>
</html>