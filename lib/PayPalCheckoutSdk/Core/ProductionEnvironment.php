<?php

namespace PayPalCheckoutSdk\Core;

class ProductionEnvironment extends PayPalEnvironment
{
    public function __construct($clientId, $clientSecret, $targetSubject = null)
    {
        parent::__construct($clientId, $clientSecret, $targetSubject);
    }

    public function baseUrl()
    {
        return "https://api.paypal.com";
    }
}
