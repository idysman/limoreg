<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>{{ trans('config.PROJECT_NAME') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ trans('config.FAVICON') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/plugins.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/structure.css") }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset("assets/css/forms/form-2.css") }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/forms/theme-checkbox-radio.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/forms/switches.css") }}">

    <style>


        .btn-primary{
            border: 1px solid {{ trans('config.BTN_COLOR') }};
            background: {{ trans("config.BTN_COLOR") }};
        }
    </style>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    {{-- {!! NoCaptcha::renderJs() !!} --}}
</head>
<body class="form">
