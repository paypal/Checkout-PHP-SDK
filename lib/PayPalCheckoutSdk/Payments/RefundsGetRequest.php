<?php

namespace PayPalCheckoutSdk\Payments;

class RefundsGetRequest extends AbstractPaymentsRequest
{
    /**
     * @param string $refundId
     */
    public function __construct($refundId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/refunds/{refund_id}?"',
                ['refund_id' => $refundId]
            ),
            'GET'
        );
    }
}
