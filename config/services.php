<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '294241500910052'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', '59fcd9ca65882a529e32e90d1f4eae5a'),
        'redirect' => env('FACEBOOK_REDIRECT', 'http://louis-laravel.dev/callback/facebook'),
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID', '81o3eidvipw9wv'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET', 'N3Z05JV9IwDb1TZA'),
        'redirect' => env('LINKEDIN_REDIRECT', 'http://louis-laravel.dev/callback/linkedin'),
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID', 'scj0NPBRKSRXijRub6xM3Eoxn'),
        'client_secret' => env('TWITTER_CLIENT_SECRET', 'kds1aD4CLhhgpCxdMDSq4j6gidUbT1oFRcxr2fmWiK6t2YnkaI'),
        'redirect' => env('TWITTER_REDIRECT', 'http://louis-laravel.dev/callback/twitter'),
    ],

];
