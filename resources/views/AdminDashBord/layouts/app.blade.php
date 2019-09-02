

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sofra</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    @CheckLang


    {{--**************************** ( Admin lte LTR ) ***************************************--}}
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/bootstrap.min.css')}}">

        <!-- Font Awesome -->
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/AdminLTE-rtl.min.css')}}">
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href = " {{asset('Adminlte_rtl/css/_all-skins-rtl.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Cairo|Roboto+Mono&display=swap" rel="stylesheet">
        <style>
            body
            {
                font-family: 'Roboto Mono', monospace;
                font-family: 'Cairo', sans-serif;
                text-align: right;
            }
            input
            {
                text-align: right;
            }
        </style>

    {{--****************************************************************************************--}}
    @else

        {{--**************************** ( Admin lte LTR ) ***************************************--}}
        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/fontAwesome.min.css')}}">

        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/AdminLTE.min.css')}}">


        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/skins/_all-skins.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Cairo|Roboto+Mono&display=swap" rel="stylesheet">
        <style>
            body
            {
                font-family: 'Roboto Mono', monospace;
                font-family: 'Cairo', sans-serif;

            }
            .menu_button
            {
                cursor: pointer;
            }


            .btn .label
            {
                padding: 0px 5px 0px 5px;
            }

            #contact_menu
            {
                background-color: white;
                position: absolute;
                width: 20pc;
                right: 1px;
                padding: 0px 1px 5px 2px;
                list-style-type: none;
                box-shadow: 4px 7px 13px -11px black;
                border: 1px solid #9999998a;
                border-radius: 0px 0px 4px 4px;
            }

            .menu
            {
                overflow: hidden;
                width: 100%;
                height: 200px;
                list-style-type: none;
                padding: 3px 1px 38px 2px;
                font-size: 11px;
            }

            .p
            {
                text-align: center;
                font-size: 17px;
                margin-top: 3pc;
                color: #444444;
            }

            .img-circle
            {
                margin: auto 10px auto auto;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                vertical-align: middle;
            }

            #Complaint
            {

                color: #721c24;
                background-color: #f8d7da;
            }

            #Complaint li
            {
                padding: 7px 1px 2px 6px;
            }

            #Complaint li:hover
            {

                background-color: #f9b3b9;
                border-bottom: 1px solid #7a232942;
            }

            #Suggestion
            {

                color: #155724;
                background-color: #d4edda;
            }

             #Suggestion li
            {
                padding: 7px 1px 2px 6px;
            }

            #Suggestion li:hover
            {
                background-color: #b8eac4;
                border-bottom: 1px solid #d4edda94;
            }

            #Enquiry li
            {
                padding: 7px 1px 2px 6px;
            }

            #Enquiry li:hover
            {
                background-color: #545b62;
                border-bottom: 1px solid #d4edda94;
            }

        </style>


        {{--****************************************************************************************--}}
    @endCheckLang


        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/dataTables.bootstrap.min.css')}}">
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="shortcut icon" href="{{asset('Admin_lte/logos/sofra.jpg')}}" />

        @yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/')}}" class="logo" style="font-family: 'Cairo', sans-serif; text-decoration: none">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{trans('sofra.SOF')}}</b>{{trans('sofra.ra')}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{trans('sofra.SOF')}}</b>{{trans('sofra.ra')}}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="fas fa-bars" data-toggle="push-menu" role="button" style="color: white;
    font-size: 22px;
    padding-top: 11px;
    padding-right: 1pc;
    text-decoration: none;
    padding-left: 1pc;">

            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    @include('AdminDashBord.layouts.contacts')

                    <li>
                        <a href="{{url('/language')}}">
                            <i class="fas fa-globe" style="    font-size: 17px;"></i>
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset(Auth()->user()->img)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset(Auth()->user()->img)}}" class="img-circle" alt="User Image">

                                <p>
                                    {{auth()->user()->name}}
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    {!! Form::open(['url'=>'logout','method'=>'potst']) !!}
                                        <button class="btn btn-default btn-flat" type="submit">Sign out</button>
                                    {!! Form::close() !!}
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>

        <div class="curtain">
    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <br>
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{Auth()->user()->img}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
        {{--                    <p>{{auth()->user()->name}}</p>--}}
                            <p>{{Auth()->user()->name}}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> {{__('sofra.online')}}</a>
                        </div>
                    </div>
                    <br>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    @include('AdminDashBord.layouts.treeview')
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('AdminDashBord.layouts.errorMassage')
                @yield('content')
            </div>
            <!-- /.content-wrapper -->

            <div class="control-sidebar-bg"></div>
        </div>
</div>
<!-- ./wrapper -->
  {{--********************************************( Admin lte LTR )**************************************--}}
{{--<!-- jQuery 3 -->--}}
<script src="{{asset('Adminlte_ltr/css/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('Adminlte_ltr/css/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('Adminlte_ltr/css/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('Adminlte_ltr/css/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Adminlte_ltr/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Adminlte_ltr/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('Adminlte_ltr/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Adminlte_ltr/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })

</script>
<script>
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('#Complaint').show();
        $('#Complaint_button').css('color' , '#721c24');
        $('#Complaint_button').css('background-color' , '#f8d7da');
        $('#Suggestion_button').css('color' , '#155724');
        $('#Suggestion_button').css('background-color' , '#d4edda');
        $('#Suggestion').hide();
        $('#Enquiry').hide();
        $('#contact_menu').hide();

    });

    $('#contact_drop_menu').click(function () {

        $('#contact_menu').toggle();
        $('.curtain').show();
    });

    $('.curtain').click(function () {

        $('#contact_menu').hide();
    });

    $('#Complaint_button').click(function () {
        $('#Complaint').show();
        $('#Suggestion').hide();
        $('#Enquiry').hide();
        $('#contact_menu').show();
    });

    $('#Suggestion_button').click(function () {
        $('#Complaint').hide();
        $('#Suggestion').show();
        $('#Enquiry').hide();
        $('#contact_menu').show();
    });

    $('#Enquiry_button').click(function () {
        $('#Complaint').hide();
        $('#Suggestion').hide();
        $('#Enquiry').show();
        $('#contact_menu').show();
    });
</script>
{{--***************************************************************************--}}
@stack('script')
@yield('script')

</body>
</html>