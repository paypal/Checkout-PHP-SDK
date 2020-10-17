<?php

namespace PayPalCheckoutSdk\Orders;

use PayPalCheckoutSdk\Core\AbstractHttpRequest;

abstract class AbstractOrdersRequest extends AbstractHttpRequest
{

    /**
     * @inheritDoc
     */
    protected function possiblePrefix()
    {
        return '/v2/checkout/orders';
    }
}
