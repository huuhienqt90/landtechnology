<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/dashboard/plugins/iCheck/all.css') }}">
    <!-- File Input -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/dist/css/fileinput.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/dashboard/custom.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- File Input -->
    <script src="{{ asset('themes/dashboard/dist/js/fileinput.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @if(auth()->user()->isSuperUser())
            @include('dashboard::commons.header')
            @include('dashboard::commons.sidebar')
        @elseif(auth()->user()->is_seller)
            @include('dashboard::layouts.commons.header-seller')
            @include('dashboard::layouts.commons.sidebar-seller')
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            @include('dashboard::messages')
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('themes/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('themes/dashboard/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Sparkline -->
    <script src="{{ asset('themes/dashboard/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('themes/dashboard/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('themes/dashboard/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('themes/dashboard/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('themes/dashboard/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('themes/dashboard/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('themes/dashboard/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('themes/dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('themes/dashboard/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- CK Editor -->
    <script src="{{ asset('themes/dashboard/bower_components/ckeditor/ckeditor.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/dashboard/dist/js/adminlte.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('themes/dashboard/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('themes/dashboard/dist/js/demo.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('input[name="name"]').keyup(function(e){
                $('input[name="slug"]').val(convertToSlug($(this).val()));
                return true;
            });
            function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-')
                    ;
            }
        });
    </script>
</body>
</html>
