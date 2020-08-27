<?php

if (rex::isBackend() && is_object(rex::getUser())) {
    rex_perm::register('http_header[]');
}

$addon = rex_addon::get('http_header');

    // --------
    // -------- X-Frame-Options
    // --------
    if($addon->getConfig('x-frame-options') != '') {

        $url = '';
        $error = 0;

        if ($addon->getConfig('x-frame-options') == 'allow-from') {
            if ($addon->getConfig('xframeurl') != '') {
                $url = ' ' . $addon->getConfig('xframeurl');
            } else {
                $error = 1;
            }
        }

        if (!$error) {
            if($addon->getConfig('x-content-type-options-nosniff_fb') == 1) {
                rex_response::setHeader('X-Frame-Options', '' . $addon->getConfig('x-frame-options') . $url . '');
            } else {
                if (rex::isFrontend()) {
                    rex_response::setHeader('X-Frame-Options', '' . $addon->getConfig('x-frame-options') . $url . '');
                }
            }
        }
    }



    // --------
    // --------  X-Content-Type-Options
    // --------
    if($addon->getConfig('x-content-type-options-nosniff') != '') {
       if($addon->getConfig('x-content-type-options-nosniff_fb') == 1) {
           rex_response::setHeader('X-Content-Type-Options', 'nosniff');
        } else {
           if (rex::isFrontend()) {
               rex_response::setHeader('X-Content-Type-Options', 'nosniff');
           }
       }
    }




    // --------
    // --------  X-Powered-By
    // --------
    if($addon->getConfig('x-powered-by-always-unset') != '') {
        if($addon->getConfig('x-powered-by_fb') == 1) {
            rex_response::setHeader('X-Powered-By', 'always unset');
           } else {
            if (rex::isFrontend()) {
                rex_response::setHeader('X-Powered-By', 'always unset');
            }
        }
    }

rex_response::setHeader('Server', 'always unset');

// -------- Referrer-Policy
/*
if($addon->getConfig('referrerpolicy') != '') {
    rex_response::setHeader('Referrer-Policy', ''.$addon->getConfig('referrerpolicy').'');
}
*/


/*
rex_response::setHeader('Strict-Transport-Security', 'max-age=31536000');
rex_response::setHeader('Content-Security-Policy', 'connect-src "self"');

rex_response::setHeader('Feature-Policy', "geolocation 'none'; midi 'none'; camera 'none'; usb 'none'; magnetometer 'none'; accelerometer 'none'; vr 'none'; speaker 'none'; ambient-light-sensor 'none'; gyroscope 'none'; microphone 'none'");
*/


