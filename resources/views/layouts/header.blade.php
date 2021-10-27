<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Analytics Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/favicon.ico") }}"/>
    <link href="{{ asset("assets/css/loader.css") }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("assets/js/loader.js") }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/plugins.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/structure.css") }}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    @yield("pageStyles")

</head>
<body class="dashboard-analytics">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->