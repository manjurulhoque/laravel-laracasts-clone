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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
	    'client_id' => 'a6c9f37007ff93c3b55e',
	    'client_secret' => '3fa3ca2ffe0bb6d5481e4458453be08b6d59cb9c',
	    'redirect' => 'http://localhost:8000/github/redirect',
    ],

    'twitter' => [
	    'client_id'     => 'nTNVUvWHurR5vVAOyl1gWwFa0',
	    'client_secret' => 'K4rkOeZnQfRW7eG5loI2fQUu9WhRAhlwsXIvOUslHFjXJsbS4P',
	    'redirect'      => 'http://localhost:8000/login/twitter/callback',
    ],

];
