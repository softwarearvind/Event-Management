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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>
            <i class="fa-solid fa-calendar-days"></i>
            Manage Events
        </h3>

        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Add Event
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($events as $key=> $event)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>
                            <img src="{{ asset('storage/'.$event->banner) }}"
                                 width="80"
                                 height="50">
                        </td>

                        <td>{{ $event->title }}</td>

                        <td>{{ $event->event_date }}</td>

                        <td>{{ $event->location }}</td>

                        <td>
                            @if($event->status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($event->status == 'Rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
<td>
    <a href="{{ route('event.edit',$event->id) }}"
       class="text-warning me-2">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('events.destroy', $event->id) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this event?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="border-0 bg-transparent text-danger">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No Events Found
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