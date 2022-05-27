<?php

require_once 'vendor/autoload.php';

// First step is to build a configuration array to pass to `Hybridauth\Hybridauth`
$config = [
    // Location where to redirect users once they authenticate with a provider
    'callback' => 'http://localhost/mojoauth/profile.php',

    // Providers specifics
    'providers' => [
        'Twitter' => [
            'enabled' => true,     // Optional: indicates whether to enable or disable Twitter adapter. Defaults to false
            'keys' => [
                'key' => '...', // Required: your Twitter consumer key
                'secret' => '...'  // Required: your Twitter consumer secret
            ]
        ],
        'Google' => ['enabled' => true, 'keys' => ['id' => '956650282322-p015uttmsolbfn88r3apgh571lmkhkmh.apps.googleusercontent.com', 'secret' => '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']], // To populate in a similar way to Twitter
        'Facebook' => ['enabled' => true, 'keys' => ['id' => '1795749547451939', 'secret' => 'b423f665cb59b1358cf60530981152ba']]  // And so on
    ]
];