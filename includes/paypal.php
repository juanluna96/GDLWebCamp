<?php

require 'paypal/autoload.php';

define('URL_SITIO', 'http://localhost/proyectos/gdlwebcamp2');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Af9YTxRPocI6q1NZbztGLPdYVLYTG6QjP765pFYXb9OcghXMMqBE_39aD-pcdoaZFKJBw0yz4O7I_wTt', // ClienteID
        'ELqhP24dVRoicDX7TuTKPzBKYpbjjdQwKUUkgGovkW1Etu7udC9EoUYz-c3JzJtTiTGkdUrm-INI40Lx' // Secret
    )
);