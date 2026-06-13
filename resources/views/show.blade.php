<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    @include('mainside')

<div class="container mt-5">

    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Back
    </a>

    <div class="card shadow">

        <!-- Event Image -->
        <img src="{{ asset('storage/'.$event->banner) }}"
             class="card-img-top"
             style="height:400px; object-fit:cover;">

        <div class="card-body">

            <h2 class="card-title">
                {{ $event->title }}
            </h2>

            <p class="text-muted">
                <i class="fa fa-calendar"></i>
                {{ $event->event_date }}
            </p>

            <p class="text-muted">
                <i class="fa fa-location-dot"></i>
                {{ $event->location }}
            </p>

            <hr>

            <h5>Description</h5>

            <p>
                {{ $event->description }}
            </p>

            <hr>

            <span class="badge bg-success">
                {{ $event->status }}
            </span>

        </div>

    </div>

</div>
@include('footer')

</body>
</html>