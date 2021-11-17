<?php

    switch (env('CURRENT_PROJECT')) {
        case 'IMO_STATE':
            return [
                "FAVICON" => asset('"assets/img/imo/favicon.jpg"'),
                "LOGO" => asset("assets/img/imo/logo.png"),
                "PROJECT_NAME" => "Imo State Vehicle Registration and Licensing System",
                "LOGO_WIDTH"=> "380px",
                "BTN_COLOR" => "#119326!important",
                "PRIMARY_COLOR" => "rgb(5,86,11)",
                "WHITE" => "#fff"
            ];
        default:
            return [
                "FAVICON" => asset("assets/img/favicon.png"),
                "LOGO" => asset("assets/img/logo.png"),
                "PROJECT_NAME" => "AUTOFLUX - Vehicle Licensing / Regsitration System",
                "LOGO_WIDTH" => "205px",
                "PRIMARY_COLOR" => "",
                "BTN_COLOR" => "",
                "WHITE" => "#fff"
            ];
            break;
    }
    
















?>