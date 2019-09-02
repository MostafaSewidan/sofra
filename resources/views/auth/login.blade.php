<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sofra</title>
    <!-- Tell the browser to be responsive to screen width -->
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

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
@include('AdminDashBord.layouts.errorMassage')
<div class="login-box">
    <div class="login-logo">
        <h1><b>Sof</b>Ra</h1>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        {!! Form::open(['url'=>'login' , 'method'=>'post']) !!}
        <div class="form-group has-feedback">
            {!! Form::email('email' , old('email') ,
             ['class'=>'form-control' ,'placeholder'=>'Email','required'=>'true','autocomplete'=>'email', 'autofocus'=>'true']) !!}

            <span class="fas fa-envelope form-control-feedback" style="padding-top: .7pc"></span>

        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password' , ['class'=>'form-control' ,'placeholder'=>'Password','required'=>'true','autocomplete'=>'current-password']) !!}
            <span class="fas fa-lock form-control-feedback" style="padding-top: .7pc"></span>
        </div>
        <div class="row" style="padding-left: 2pc">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('Adminlte/css/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('Adminlte/css/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('Adminlte/css/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('Adminlte/css/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Adminlte/js/demo.js')}}"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
