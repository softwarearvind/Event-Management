 <div class="row">

        <div class="col-md-3">

            <div class="card bg-primary text-white shadow">

                <div class="card-body">

                    <h6>Total Users</h6>

                    <h2>
                        {{ $totalUsers ?? 500 }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-success text-white shadow">

                <div class="card-body">

                    <h6>Total Managers</h6>

                    <h2>
                        {{ $totalManagers ?? 25 }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-warning text-white shadow">

                <div class="card-body">

                    <h6>Total Roles</h6>

                    <h2>5</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-danger text-white shadow">

                <div class="card-body">

                    <h6>Revenue</h6>

                    <h2>₹50K</h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Chart -->

    <div class="row mt-4">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    User Statistics
                </div>

                <div class="card-body">

                    <canvas id="adminChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- Recent Users -->

    <div class="card shadow mt-4">

        <div class="card-header">
            Recent Users
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Arvind</td>
                        <td>admin@gmail.com</td>
                        <td>Admin</td>

                        <td>
                            <span class="badge bg-success">
                                Active
                            </span>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>
