<?php

namespace PayPalCheckoutSdk\Payments;

use PayPalCheckoutSdk\Core\AbstractHttpRequest;

abstract class AbstractPaymentsRequest extends AbstractHttpRequest
{
    /**
     * @inheritDoc
     */
    protected function possiblePrefix()
    {
        return '/v2/payments';
    }
}
