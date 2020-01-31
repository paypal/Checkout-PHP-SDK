<?php

namespace PayPalCheckoutSdk\Core\Request;

trait HeaderRequestIdTrait
{
    /**
     * @param string $payPalRequestId
     */
    public function payPalRequestId($payPalRequestId)
    {
        $this->headers["PayPal-Request-Id"] = $payPalRequestId;
    }
}
