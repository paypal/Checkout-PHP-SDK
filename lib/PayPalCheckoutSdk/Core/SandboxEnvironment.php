<?php

namespace PayPalCheckoutSdk\Core;

class SandboxEnvironment extends PayPalEnvironment
{
    public function __construct($clientId, $clientSecret, $targetSubject = null)
    {
        parent::__construct($clientId, $clientSecret, $targetSubject);
    }

    public function baseUrl()
    {
        return "https://api.sandbox.paypal.com";
    }
}
