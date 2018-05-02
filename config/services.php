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
    
    'braintree' => [
        'model'  => App\Models\User::class,
        'environment' => env('BRAINTREE_ENV', 'sandbox'),
        'merchant_id' => env('BRAINTREE_MERCHANT_ID', 'fhxxnh27vv8fjwzy'),
        'public_key'  => env('BRAINTREE_PUBLIC_KEY', 'g33tjhcm3z5vb889'),
        'private_key' => env('BRAINTREE_PRIVATE_KEY', '44e25ec1e8f9ff3a95d6d50a224ca7f9'),
    ],

];
