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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'mtn_momo' => [
    'subscription_key' => env('MTN_MOMO_SUBSCRIPTION_KEY'),
    'environment' => env('MTN_MOMO_ENVIRONMENT', 'sandbox'),
    'api_user_id' => env('MTN_MOMO_API_USER_ID'),
    'api_user_password' => env('MTN_MOMO_API_USER_PASSWORD'),
    'callback_url' => env('MTN_MOMO_CALLBACK_URL'),
],
'fedapay' => [
    'public_key' => env('FEDAPAY_PUBLIC_KEY'),
    'secret_key' => env('FEDAPAY_SECRET_KEY'),
    'env' => env('FEDAPAY_ENV', 'sandbox'),
],


];
