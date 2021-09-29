<?php

namespace PayPalCheckoutSdk\Setup;

use PayPalCheckoutSdk\Core\PayPalEnvironment;

class SandboxEnvironment extends PayPalEnvironment
{
    public function baseUrl()
    {
        return "https://api.sandbox.paypal.com";
    }
}
