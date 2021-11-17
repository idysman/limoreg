<?php

    switch (env('CURRENT_PROJECT')) {
        case 'IMO_STATE':
            return [
                "FAVICON" => "assets/img/imo/favicon.jpg",
                "LOGO" => "assets/img/imo/logo.png",
                "PROJECT_NAME" => "Imo State Vehicle Registration and Licensing System",
                "LOGO_WIDTH"=> "380px"
            ];
        default:
            return [
                "FAVICON" => "assets/img/favicon.png",
                "LOGO" => "assets/img/logo.png",
                "PROJECT_NAME" => "AUTOFLUX - Vehicle Licensing / Regsitration System",
                "LOGO_WIDTH" => "205px"
            ];
            break;
    }
    
















?>