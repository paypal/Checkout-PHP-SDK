<?php

namespace PayPalCheckoutSdk\Orders;

class OrdersPatchRequest extends AbstractOrdersRequest
{
    /**
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/{order_id}?',
                ['order_id' => $orderId]
            ),
            'PATCH'
        );
    }
}
