<?php

// defining mojoauth

define('MOJOAUTH_APIKEY', '1f06adda-3113-4407-b768-03b2f06a113a'); //update your mojoauth account's APIKey
define('MOJOAUTH_LANG', 'en'); // Check out the localization document below for other supported languages.
define('MOJOAUTH_TOKEN_HANDLER', 'http://localhost/mojoauth/tokenhandler.php');  // Change the path as per your folder structure
define('MOJOAUTH_REDIRECTION_URL', 'http://localhost/mojoauth/profile.php?issuer=mojoauth');   // Change the path as per your folder structure
session_start();