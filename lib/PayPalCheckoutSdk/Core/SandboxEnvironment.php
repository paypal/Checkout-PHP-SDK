<?php

namespace PayPalCheckoutSdk\Core;

class SandboxEnvironment extends PayPalEnvironment
{
    /**
     * @inheritDoc
     */
    public function baseUrl()
    {
        return 'https://api.sandbox.paypal.com';
    }
}
