<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? "Home" }} | {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ callAdminStaticResources('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ callAdminStaticResources('dist/css/adminlte.min.css') }}">
    <style>
        .card-header-right{
            float: right;
        }
        .select2-selection__choice{
            background-color: #4293eb!important;
            border-color: #4293eb!important;
        }
        .select2-selection__choice__remove{
            color: #ffffff!important;
        }
        .select2-selection--single{
            height: 40px !important;
        }
        .select2-selection__arrow{
            top: 8px!important;
            right: 5px!important;
        }
        .form-error-message{
            color: darkred;
        }

        .search-part{
            display:inline-block;
        }

        .card-header .header-top h5{
            float:left;
        }

        .card-header-right .input-group-text{
            background-color:#007bff;
            border-color:#007bff;
        }

        .card-header-right .input-group-text .fa-search{
            color:#fff;
        }

        /*-----Media Query----*/

        @media (max-width: 640px) {
            .card-header-right{
                 margin-top:5px;
             }
            .card-header-right .btn{
                font-size:14px;
                margin-bottom:5px;
            }
            /*.card-header-right .btn:last-child{*/
            /*    margin-bottom:0;*/
            /*}*/
        }

        @media (max-width: 576px)
        {
            .card-header-right,
            .card-header .header-top h5{
                float:none;
            }
        }

         @media (max-width: 480px){

             .card-header-right .btn{
                 font-size:12px;
             }
         }


    </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" style="padding: 0px;height: auto;">
                    <img class="img-circle img-bordered-sm"  onerror="this.src='{{ asset('user.png') }}'" src="{{ asset('user.png') }}" alt="User Image" style="height: 30px; width: 30px;">
                    User
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">

                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="$('#logoutform').submit()">
                        <i class="fas fa-lock"></i> Logout
                    </a>
                    <form action="{{ route('admin.logout.post') }}" method="post" id="logoutform">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @include($theme_path.'.particle.sidebar')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    @php
    if (!isset($menutitle)){
        $menutitle = true;
    }
    @endphp

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if($menutitle)
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title ?? "Dashboard" }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title ?? "Dashboard" }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @else
            <div class="content-header"></div>
        @endif

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ callAdminStaticResources('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ callAdminStaticResources('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ callAdminStaticResources('dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ callAdminStaticResources('plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ callAdminStaticResources('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ callAdminStaticResources('dist/js/pages/dashboard3.js') }}"></script>


<script src="{{ asset('static_asset/admin/theme_one/plugins/notify/sweetalert.min.js') }}"></script>

<script>
    @if(session('success'))
    swal("Success!", "{{ session('success') }}", "success");
    @endif

    @if(session('error'))
    swal("Sorry!", "{{ session('error') }}", "error");
    @endif

    $('.delete-btn').click(function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    $('#delete'+id).submit();
                }
            });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    var date = new Date();
    date.setDate(date.getDate());

    $( function() {
        $( ".datepicker" ).datepicker({
            format : "yyyy-mm-dd",
            endDate: new Date()
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
      integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script>
    $('.select2').select2();
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@stack('js')

</body>
</html>
