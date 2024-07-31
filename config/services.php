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
    'facebook' => [
        'client_id' => env('facebook_CLIENT_ID'),
        'client_secret' => env('facebook_secret_ID'),
        'redirect' => env('facebook_redirect'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_secret_ID'),
        'redirect' => env('GOOGLE_redirect'),
    ],
    'github' => [
        'client_id' => env('github_CLIENT_ID'),
        'client_secret' => env('github_secret_ID'),
        'redirect' => env('github_redirect'),
    ],
    'instagram' => [
        'client_id' => env('instagram_CLIENT_ID'),
        'client_secret' => env('instagram_secret_ID'),
        'redirect' => env('instagram_redirect'),
    ],
    'twitter' => [
        'client_id' => env('twitter_CLIENT_ID'),
        'client_secret' => env('twitter_secret_ID'),
        'redirect' => env('twitter_redirect'),
     ],


];
