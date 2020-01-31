<?php

namespace PayPalCheckoutSdk\Core\Request;

trait HeaderPartnerAttributionIdTrait
{
    /**
     * @param string $payPalPartnerAttributionId
     */
    public function payPalPartnerAttributionId($payPalPartnerAttributionId)
    {
        $this->headers["PayPal-Partner-Attribution-Id"] = $payPalPartnerAttributionId;
    }
}
