<?php

namespace PayPalCheckoutSdk\Setup;

use PayPalCheckoutSdk\Core\PayPalEnvironment;

class ProductionEnvironment extends PayPalEnvironment
{
    public function baseUrl()
    {
        return "https://api.paypal.com";
    }
}
