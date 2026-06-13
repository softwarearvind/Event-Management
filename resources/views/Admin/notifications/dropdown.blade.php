<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<li class="nav-item dropdown">

    @php
        $notifications = Auth::check()
            ? Auth::user()->unreadNotifications->take(10)
            : collect();
    @endphp

    <a class="nav-link position-relative"
       href="#"
       id="notificationDropdown"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">

        <i class="fas fa-bell fs-4 text-dark"></i>

        @if($notifications->count())
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $notifications->count() }}
            </span>
        @endif

    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0"
        aria-labelledby="notificationDropdown"
        style="width:400px; max-height:450px; overflow-y:auto;">

        <li class="bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <strong>
                    <i class="fas fa-bell me-2"></i>
                    Notifications
                </strong>

                <span class="badge bg-light text-dark">
                    {{ $notifications->count() }}
                </span>
            </div>
        </li>

        @forelse($notifications as $notification)

            <li>
                <a href="#"
                   class="dropdown-item py-3">

                    <div class="d-flex">

                        <div class="me-3">
                            <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center"
                                 style="width:40px;height:40px;">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark">
                                {{ $notification->data['message'] ?? 'New Notification' }}
                            </div>

                            <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>

                    </div>
                </a>
            </li>

            <li><hr class="dropdown-divider m-0"></li>

        @empty

            <li class="text-center p-4">
                <i class="fas fa-bell-slash fa-3x text-secondary"></i>

                <p class="mt-3 mb-0 text-muted">
                    No Notifications Found
                </p>
            </li>

        @endforelse

    </ul>

</li>