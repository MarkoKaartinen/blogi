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

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'wordpress' => [
        'url' => env('WORDPRESS_URL'),
        'username' => env('WORDPRESS_USERNAME'),
        'password' => env('WORDPRESS_PASSWORD'),
    ],

    'mastodon' => [
        'token' => env('MASTODON_TOKEN'),
        'instance' => env('MASTODON_INSTANCE'),
        'user_id' => env('MASTODON_USER_ID'),
        'profile_url' => env('MASTODON_PROFILE_URL'),
    ],

    'plausible' => [
        'url' => env('PLAUSIBLE_URL'),
        'site_id' => env('PLAUSIBLE_SITE_ID'),
        'key' => env('PLAUSIBLE_KEY'),
    ]
];
