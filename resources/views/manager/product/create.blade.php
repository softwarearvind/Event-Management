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

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Product (Send for Approval)</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ url('/product/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Multiple Images -->
                        <div class="mb-3">
                            <label>Product Images</label>
                            <input type="file" name="images[]" class="form-control" multiple>

                            @error('images')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @error('images.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Preview Images (optional JS) -->
                        <div class="mb-3">
                            <div id="preview" class="d-flex gap-2 flex-wrap"></div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-success w-100">
                            Send for Approval
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>




</div>



</body>
<script>
document.querySelector('input[name="images[]"]').addEventListener('change', function(event) {
    let preview = document.getElementById('preview');
    preview.innerHTML = '';

    for (let i = 0; i < event.target.files.length; i++) {
        let file = event.target.files[i];
        let reader = new FileReader();

        reader.onload = function(e) {
            let img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = "80px";
            img.style.height = "80px";
            img.style.objectFit = "cover";
            img.classList.add("rounded", "border");
            preview.appendChild(img);
        }

        reader.readAsDataURL(file);
    }
});
</script>
</html>