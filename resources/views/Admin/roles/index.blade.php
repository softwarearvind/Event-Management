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

    <!-- Page Header -->

    <div class="card shadow mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-0">
                    Roles & Permissions Management
                </h3>

                <small class="text-muted">
                    Manage Roles and Permissions
                </small>
            </div>

            <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addRoleModal">

                <i class="fas fa-plus"></i>
                Add Role

            </button>

        </div>
    </div>

    <!-- Statistics -->

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card bg-primary text-white shadow">

                <div class="card-body">

                    <h6>Total Roles</h6>

                    <h2>{{ $rolesCount }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card bg-success text-white shadow">

                <div class="card-body">

                    <h6>Total Permissions</h6>

                    <h2>{{ $permissionsCount }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card bg-warning text-white shadow">

                <div class="card-body">

                    <h6>Users With Roles</h6>

                    <h2>{{ $usersWithRoles }}</h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Roles Table -->

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                All Roles
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Total Permissions</th>
                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($roles as $role)

                    <tr>

                        <td>{{ $role->id }}</td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $role->name }}

                            </span>

                        </td>

                        <td>

                            {{ $role->permissions->count() }}

                        </td>

                        <td>

                            <button class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewRole{{ $role->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm">

                                <i class="fas fa-trash"></i>

                            </button>

                        </td>

                    </tr>

                    <!-- View Role Modal -->

                    <div class="modal fade"
                         id="viewRole{{ $role->id }}">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                                <div class="modal-header bg-info text-white">

                                    <h5>
                                        {{ $role->name }}
                                        Permissions
                                    </h5>

                                    <button class="btn-close"
                                            data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        @foreach($role->permissions as $permission)

                                        <div class="col-md-4 mb-2">

                                            <span class="badge bg-success">

                                                {{ $permission->name }}

                                            </span>

                                        </div>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- Permission Assignment -->

    <div class="card shadow mt-4">

        <div class="card-header bg-primary text-white">

            Assign Permissions To Role

        </div>

        <div class="card-body">

            <form action="{{ route('roles.permission.assign') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label>
                        Select Role
                    </label>

                    <select name="role_id"
                            class="form-control">

                        @foreach($roles as $role)

                        <option value="{{ $role->id }}">

                            {{ $role->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="row">

                    @foreach($permissions as $permission)

                    <div class="col-md-3">

                        <div class="form-check">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->id }}">

                            <label class="form-check-label">

                                {{ $permission->name }}

                            </label>

                        </div>

                    </div>

                    @endforeach

                </div>

                <button class="btn btn-success mt-3">

                    <i class="fas fa-save"></i>

                    Assign Permissions

                </button>

            </form>

        </div>

    </div>

</div>


<!-- Add Role Modal -->

<div class="modal fade"
     id="addRoleModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="{{ route('roles.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header bg-primary text-white">

                    <h5>
                        Add New Role
                    </h5>

                </div>

                <div class="modal-body">

                    <label>
                        Role Name
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        Save Role

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


    <!-- Dashboard Cards -->
</div>


</body>
</html>