<?php

namespace PayPalCheckoutSdk\Payments;

use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;
use PayPalCheckoutSdk\Core\Request\HeaderRequestIdTrait;

class CapturesRefundRequest extends AbstractPaymentsRequest
{
    use HeaderRequestIdTrait, HeaderPreferTrait;

    /**
     * @param string $captureId
     */
    public function __construct($captureId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/captures/{capture_id}/refund?"',
                ['capture_id' => $captureId]
            ),
            'POST'
        );
    }
}
