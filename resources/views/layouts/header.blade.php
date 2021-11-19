<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ trans('config.PROJECT_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ trans('config.FAVICON') }}"/>
    <link href="{{ asset("assets/css/loader.css") }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("assets/js/loader.js") }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/plugins.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/structure.css") }}" rel="stylesheet" type="text/css" class="structure" />

    <script src="{{ asset("assets/js/promise-polyfill.js") }}"></script>
    <link href="{{ asset("assets/css/sweetalert2.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/sweetalert.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/custom-sweetalert.css") }}" rel="stylesheet" type="text/css" />
    
    <!-- END GLOBAL MANDATORY STYLES -->
    <style>

        .btn-primary{
            border: 1px solid {{ trans('config.BTN_COLOR') }};
            background: {{ trans("config.BTN_COLOR") }};
        }
        .dt-buttons button.dt-button{
            background: {{ trans("config.BTN_COLOR") }};
            border: 1px solid {{ trans("config.BTN_COLOR") }};
        }

        .badge-primary{
            border: 1px solid {{ trans('config.BTN_COLOR') }};
            background: {{ trans("config.BTN_COLOR") }};
        }
      
        .form-item {
            font-size: 12px;
            font-weight: 700;
            color: #888ea8;
            border:none;
            background:none;
            padding-top: 11px;
            padding-bottom: 11px;
            border-radius: 5px;
            text-align: left;
        }
        .form-item:hover{
            background:#f1f2f3;
            width:100%;
            display:block;
            padding-left:8px
           
        }
    
    </style>

    @yield("pageStyles")

    @livewireStyles
</head>
<body class="dashboard-analytics">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
