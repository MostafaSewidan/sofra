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



        {{--****************************************************************************************--}}
        @endCheckLang
        <style>
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            *::before,
            *::after {
                content: '';
                position: absolute;
            }

            body{
                background: #1B0034;
                background-image: linear-gradient( 135deg, #1B0034 10%, #33265C 100%);
                background-attachment: fixed;
                background-size: cover;

            }

            .error {
                width: 100%;
                height: auto;
                margin: 50px auto;
                text-align: center;
                margin-bottom: 0;
            }

            .dracula{
                width: 230px;
                height: 300px;
                display: inline-block;
                margin: auto;
                overflowX: hidden;
            }

            .error .p {
                height: 100%;
                color: #C0D7DD;
                font-size: 280px;
                margin: 50px;
                display: inline-block;
                font-family: 'Anton', sans-serif;
                font-family: 'Combo', cursive;
            }


            .con {
                width: 500px;
                height: 500px;
                position: relative;
                margin: 9% auto 0;
                animation: ani9 0.7s ease-in-out infinite  alternate ;}

            @keyframes ani9 {
                0%{
                    transform: translateY(10px);
                }

                100%{
                    transform: translateY(30px);
                }

            }


            .con > * {
                position: absolute;
                top: 0; left: 0;
            }

            .hair{
                top: -20px;
                width: 210px;
                height: 200px;
                background: #C0D7DD;
                border-radius: 0 50% 0 50%;
                transform: rotate(45deg);
                background: #33265C;
            }
            .hair-r{
                left: 20px;
                width: 210px;
                height: 200px;
                background: #C0D7DD;
                border-radius: 0 50% 0 50%;
                transform: rotate(45deg);
                background: #33265C;

            }
            .head {
                width: 200px;
                height: 200px;
                background: #C0D7DD;
                border-radius: 0 50% 0 50%;
                transform: rotate(45deg);
            }
            .eye {
                width: 20px; height:20px;
                background: #111113;
                border-radius: 50%;
                top: 15%; left: 11.5%;
                transition: .3s linear;
            }
            .eye-r{left: 24%;}

            .mouth {
                width: 60px;
                height: 20px;
                background: #840021;
                top: 20%;
                left: 14%;
                border-radius: 50% / 0 0 100% 100%;
            }
            .mouth::after{

                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 13px solid #FFFFFF;
                left: 10px;

            }
            .mouth::before{
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 13px solid #FFFFFF;
                left: 40px;
            }

            .blod {
                width: 8px;
                height: 20px;
                background: #840021;
                top: 23%; left: 17%;
                border-radius: 20px;
            }
            .blod::after{
                width: 2px;
                height: 10px;
                background: #FFF;
                top: 20%; left: 10%;
                border-radius: 20px;

            }
            .blod2 {
                top: 23%; left: 20%;
                width: 13px;
                height: 13px;
                border-radius: 50% 50% 50% 0;
                transform: rotate(130deg);
                animation: blod 2s linear infinite;
                opacity: 0;
            }
            @keyframes blod {
                0%   {opacity: 1;}
                100%   {background:red; opacity: 0; top:50%;}


            }



            /* page-ms */
            .page-ms {transform: translateY(-50px);}

            .error p.page-msg {
                text-align: center;
                color: #C0D7DD;
                font-size: 30px;
                font-family: 'Combo', cursive;
                margin-bottom: 20px;
            }
            button.go-back {
                font-size: 30px;
                font-family: 'Combo', cursive;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                transition: 0.3s linear;
                z-index: 9;
                border-radius: 10px;
                background: #C0D7DD;
                color: #33265C;
                box-shadow: 0 0 10px 0 #C0D7DD;
                margin-top: 20px;
            }
            button:hover {box-shadow: 0 0 20px 0 #C0D7DD;}


        </style>

        <link rel="stylesheet" href="{{asset('Adminlte_ltr/css/dataTables.bootstrap.min.css')}}">
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="shortcut icon" href="{{asset('Admin_lte/logos/sofra.jpg')}}" />

</head>
<body class="hold-transition skin-blue sidebar-mini">




    <div class="container">

        <div  class="error">
            <p class="p">4</p>
            <span class="dracula">
			<div class="con">
				<div class="hair"></div>
				<div class="hair-r"></div>
				<div class="head"></div>
    		<div class="eye"></div>
    		<div class="eye eye-r"></div>
  			<div class="mouth"></div>
  			<div class="blod"></div>
  			<div class="blod blod2"></div>
			</div>
		</span>
            <p class="p">3</p>

            <div class="page-ms">
                <p class="page-msg"> Oops, You are forbidden from accessing this page</p>
                <a class="go-back" href="{{url('/')}}">Go Home</a>
            </div>
        </div>
    </div>

    <iframe style="width:0;height:0;border:0; border:none;" scrolling="no" frameborder="no" allow="autoplay" src="https://instaud.io/_/2Vvu.mp3"></iframe>

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

</body>
</html>