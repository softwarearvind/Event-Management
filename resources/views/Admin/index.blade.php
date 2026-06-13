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

        <style>
.notification-box{
    background:#fff;
    border:1px solid #dee2e6;
    border-radius:10px;
    padding:8px 12px;
    box-shadow:0 2px 8px rgba(0,0,0,.08);
}

.notification-box .navbar-nav{
    margin:0;
}

.notification-box .nav-link{
    padding:0;
}

.notification-box .fa-bell{
    font-size:22px;
    color:#0d6efd;
    cursor:pointer;
}

.notification-box .fa-bell:hover{
    color:#084298;
}
</style>

    </style>

</head>
<body>

<!-- Sidebar -->

@include('layout.adminsidebar')




<!-- Main Content -->

<div class="main-content">

    <!-- Top Navbar -->

 <div class="card shadow mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-0">Admin Dashboard</h3>
        </div>

        <div class="d-flex align-items-center gap-4">

            <div>
                Welcome,
                <strong>{{ Auth::user()->name }}</strong>
            </div>

            <div class="notification-box">
                <ul class="navbar-nav">
                    @include('Admin.notifications.dropdown')
                </ul>
            </div>

        </div>

    </div>
</div>
    <!-- Dashboard Cards -->

   @include('layout.adminmain')
</div>

<script>

new Chart(document.getElementById('adminChart'), {

    type:'doughnut',

    data:{

        labels:[
            'Users',
            'Managers',
            'Admins'
        ],

        datasets:[{

            data:[
                400,
                80,
                20
            ],

            backgroundColor:[
                '#0d6efd',
                '#198754',
                '#dc3545'
            ]

        }]

    }

});

</script>

</body>
</html>