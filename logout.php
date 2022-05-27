<?php

// requiring both configuration for both providers
require_once(__DIR__ . "/config.php");
require_once 'config-hybridauth.php';



// getting the data passed from URL to check the issuer

//logout process for mojoauth. since the response/user details is stored in the session, destroy it to logout.
if (isset($_GET['issuer']) == "mojoauth") {

    session_unset();
    // destroy the session
    session_destroy();
    header("Location: index.php");

    // logout process for fb and google. It's the same process for both. and I've called the inbuilt class of the API
    // to logout.
} else if (isset($_GET['issuer']) == "facebook") {
    require_once 'fb.php';
    $adapterFB->disconnect();
    header("Location: index.php");
} else {
    require_once 'google.php';
    $adapterGoogle->disconnect();
    header("Location: index.php");
}