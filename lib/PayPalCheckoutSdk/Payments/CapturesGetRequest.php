<?php

namespace PayPalCheckoutSdk\Payments;

class CapturesGetRequest extends AbstractPaymentsRequest
{
    /**
     * @param string $captureId
     */
    public function __construct($captureId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/captures/{capture_id}?"',
                ['capture_id' => $captureId]
            ),
            'GET'
        );
    }
}
