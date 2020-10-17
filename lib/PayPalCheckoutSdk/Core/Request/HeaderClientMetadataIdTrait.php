<?php

namespace PayPalCheckoutSdk\Core\Request;

trait HeaderClientMetadataIdTrait
{
    /**
     * @param string $payPalClientMetadataId
     */
    public function payPalClientMetadataId($payPalClientMetadataId)
    {
        $this->headers["PayPal-Client-Metadata-Id"] = $payPalClientMetadataId;
    }
}
