<!DOCTYPE html>
<html>
<head>
    <title>Event Ticket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .ticket {
            border: 2px dashed #333;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
  @include('mainside')
<div class="container mt-5">

    <div class="ticket shadow">

        <h2>{{ $event->title }}</h2>

        <p><b>Date:</b> {{ $event->event_date }}</p>
        <p><b>Location:</b> {{ $event->location }}</p>

        <hr>

        <!-- QR Code -->
        <div class="mb-3">

            {!! QrCode::size(200)->generate(
                url('/event/'.$event->id)
            ) !!}

        </div>

        <p class="text-muted">
            Scan QR to view event details
        </p>

    </div>

</div>
@include('footer')
</body>
</html>