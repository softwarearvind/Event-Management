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

<!-- Sidebar -->

@include('layout.adminsidebar')

<!-- Main Content -->

<div class="main-content">

    <!-- Top Navbar -->

    <div class="card shadow mb-4">
        <div class="card-body d-flex justify-content-between">

            <h3>
                Admin Dashboard
            </h3>

            <div>
                Welcome,
                <strong>{{ Auth::user()->name }}</strong>
            </div>

        </div>
    </div>

<div class="container">

    <div class="card shadow">
        <div class="card-header">
            <h4>Manage Events</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($events as $event)

                    <tr>

                        <td>
                            <img src="{{ asset('storage/'.$event->banner) }}"
                                 width="100">
                        </td>

                        <td>{{ $event->title }}</td>

                        <td>{{ $event->event_date }}</td>

                        <td>{{ $event->location }}</td>

                        <td>

                            @if($event->status == 'Pending')
                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @elseif($event->status == 'Approved')
                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @else
                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($event->status == 'Pending')

                            <form action="{{ route('admin.events.approve',$event->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf

                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.events.reject',$event->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf

                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>

</div>



    <!-- Dashboard Cards -->

   
</div>



</body>
</html>