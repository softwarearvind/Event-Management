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

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h4>
                <i class="fa-solid fa-calendar-plus"></i>
                Create Event
            </h4>

            <a href="{{ route('event.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('events.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Event Title -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Enter Event Title"
                               required>
                    </div>

                    <!-- Event Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date"
                               name="event_date"
                               class="form-control"
                               required>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text"
                               name="location"
                               class="form-control"
                               placeholder="Enter Event Location"
                               required>
                    </div>

                    <!-- Banner -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Banner</label>
                        <input type="file"
                               name="banner"
                               class="form-control"
                               accept="image/*">
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="5"
                                  class="form-control"
                                  placeholder="Enter Event Description"></textarea>
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Submit Event
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>




</div>



</body>
</html>