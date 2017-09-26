<?php
return [
    'Sandbox' => env('PayPalSandbox', true),
    'APIUsername' => env('APIUsername', 'testbusinessland_api1.gmail.com'),
    'APIPassword' => env('APIPassword', 'VGXHFPCWBENC3BW4'),
    'APISignature' => env('APISignature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AOOkSHqaScUWmTrGy2zvPQKqzWc0'),
    'clientId' => env('PayPalClientId', 'AZrF7au7DWcIKrKApaOzaVZq-8nd2CD3_adxF5lrmJEARxJVTsbSGXYalT53l8WVdygjmZzT6LJM2Hzs'),
    'clientSecret' => env('PayPalClientSecret', 'EP8lLv8sWIMNqe3WrQ2gLXqIjhvsW-dX3hUDRLz2aEsQMfLfCftpCsEDK81Bu4PZxwUMq6u5pruzk2y-'),
    'log' => [
        'LogEnabled' => true,
        'FileName' => storage_path('app/logs/PayPal.log'),
        'LogLevel' => 'DEBUG'
    ],
    'cache' => [
        'enabled' => true
    ]
];
