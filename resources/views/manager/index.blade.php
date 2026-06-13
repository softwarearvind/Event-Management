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

   @include('layout.managermain')

</div>

<script>
const ctx = document.getElementById('pieChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            'Active Users',
            'Inactive Users',
            'Managers',
            'Admins'
        ],
        datasets: [{
            data: [120, 30, 15, 5],
            backgroundColor: [
                '#198754',
                '#dc3545',
                '#0d6efd',
                '#ffc107'
            ]
        }]
    }
});
</script>

</body>
</html>