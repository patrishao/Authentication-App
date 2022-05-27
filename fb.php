<?php

require_once 'config-hybridauth.php';

try {
    $hybridauthFB = new Hybridauth\Hybridauth($config);
    $adapterFB = $hybridauthFB->authenticate('Facebook');
    $isConnectedFB = $adapterFB->isConnected();
    $userProfileFB = $adapterFB->getUserProfile();
} catch (\Exception $e) {
}