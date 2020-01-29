<?php

namespace PayPalCheckoutSdk\Core;

class ProductionEnvironment extends PayPalEnvironment
{

    /**
     * @inheritDoc
     */
    public function baseUrl()
    {
        return 'https://api.paypal.com';
    }
}
