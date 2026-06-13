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

    <div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Users Management
            </h4>

           <a href="#" class="btn btn-light addUserBtn"
               data-bs-toggle="modal"
               data-bs-target="#addUserModal">
                <i class="fas fa-plus"></i>
                Add User
            </a>


        </div>


        <div class="modal fade" id="addUserModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

         <form id="userForm" action="{{ route('users.store') }}" method="POST">
          @csrf
           <input type="hidden" name="user_id" id="user_id">

                <div class="modal-header">

                    <h5 class="modal-title" id="modalTitle">
                        Add User
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>

                  <div class="mb-3">
                    <label>Role</label>

                    <select name="role" class="form-control" required>

                        <option value="">
                            Select Role
                        </option>

                        @foreach($roles as $role)

                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Save User
                    </button>

                </div>

            </form>

        </div>

    </div>



</div>

        <div class="card-body">

            <!-- Search -->

            <form method="GET">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search User">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>

                </div>

            </form>

            <!-- Table -->

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($users as $user)


                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $user->getRoleNames()->first() }}

                                </span>

                            </td>

                            <td>

                                @if($user->status == 1)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $user->created_at->format('d-m-Y') }}

                            </td>

                            <td>

                               <a href="#"
                               class="btn btn-info btn-sm"
                               data-bs-toggle="modal"
                               data-bs-target="#viewUser{{ $user->id }}">

                                <i class="fas fa-eye"></i>
                            </a>

                              <button
                                class="btn btn-warning btn-sm editUserBtn"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                                data-role="{{ $user->getRoleNames()->first() }}"
                                data-bs-toggle="modal"
                                data-bs-target="#addUserModal">

                                <i class="fas fa-edit"></i>
                            </button>

                                <form action="{{ route('users.destroy',$user->id) }}"
                                      method="POST"
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        <!-- View User Modal -->
<div class="modal fade" id="viewUser{{ $user->id }}" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-info text-white">

                <h5 class="modal-title">
                    User Details
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12 text-center mb-3">

                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                             width="100"
                             class="rounded-circle border">

                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>ID</b></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->id }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>Name</b></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->name }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>Email</b></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->email }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>Role</b></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->getRoleNames()->first() }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>Status</b></label>

                        @if($user->status == 1)
                            <input type="text"
                                   class="form-control text-success"
                                   value="Active"
                                   readonly>
                        @else
                            <input type="text"
                                   class="form-control text-danger"
                                   value="Inactive"
                                   readonly>
                        @endif

                    </div>

                    <div class="col-md-6 mb-3">
                        <label><b>Created Date</b></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->created_at->format('d-m-Y h:i A') }}"
                               readonly>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>

            </div>

        </div>

    </div>

</div>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->

            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

    <!-- Dashboard Cards -->


</div>
<style>
#toast-container{
    top:20px !important;
    right:20px !important;
}

.toast{
    opacity:1 !important;
}
</style>

<script>
$(document).ready(function () {

    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "preventDuplicates": true
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

});
</script>

</body>

<script>
$('.editUserBtn').click(function(){

    $('#modalTitle').text('Edit User');

    $('#user_id').val($(this).data('id'));

    $('input[name="name"]').val($(this).data('name'));

    $('input[name="email"]').val($(this).data('email'));

    $('select[name="role"]').val($(this).data('role'));

    $('#userForm').attr('action',
        '/users/update/' + $(this).data('id')
    );
});
</script>

<script>
$('.addUserBtn').click(function(){

    $('#modalTitle').text('Add User');

    $('#userForm')[0].reset();

    $('#user_id').val('');

    $('#userForm').attr('action',
        '{{ route("users.store") }}'
    );
});
</script>

</html>