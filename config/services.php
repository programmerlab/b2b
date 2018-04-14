<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => \Ribrit\Mars\Database\Models\User\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET', '3d239d5f219c198fe3bd0543c104a65de68e5bc3'),
    ],

    'twitter' => [
        'client_id'     => env('TWITTER_KEY', ''),
        'client_secret' => env('TWITTER_SECRET', ''),
        'redirect'      => env('TWITTER_REDIRECT', url('auth/login/twitter/related'))
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_KEY', ''),
        'client_secret' => env('FACEBOOK_SECRET', ''),
        'redirect'      => env('FACEBOOK_REDIRECT', url('auth/login/facebook/related'))
    ],

];
