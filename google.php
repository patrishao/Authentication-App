<?php

require_once 'config-hybridauth.php';


try {
    $hybridauthGoogle = new Hybridauth\Hybridauth($config);
    $adapterGoogle = $hybridauthGoogle->authenticate('Google');
    $isConnectedGoogle = $adapterGoogle->isConnected();
    $userProfileGoogle = $adapterGoogle->getUserProfile();
} catch (\Exception) {
}