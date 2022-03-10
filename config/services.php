<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyCzODaLq-kyU-XtpTWnqgrq6wjFGC2F8f0',
        'auth_domain' => 'tes-kaspin-4333c.firebaseapp.com',
        'database_url' => 'tes-kaspin-4333c.firebaseio.com',
        'project_id' => 'tes-kaspin-4333c',
        'storage_bucket' => 'tes-kaspin-4333c.appspot.com',
        'messaging_sender_id' => '233430302853',
        'app_id' => '1:233430302853:web:bc3b1d0a536059c8d769ec',
        'measurement_id' => 'G-HPWS2KM4RW',
    ],

];
