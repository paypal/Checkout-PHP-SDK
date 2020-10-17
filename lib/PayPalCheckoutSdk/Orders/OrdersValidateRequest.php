<?php

namespace PayPalCheckoutSdk\Orders;

use PayPalCheckoutSdk\Core\Request\HeaderClientMetadataIdTrait;

class OrdersValidateRequest extends AbstractOrdersRequest
{
    use HeaderClientMetadataIdTrait;

    /**
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/{order_id}/validate-payment-method?',
                ['order_id' => $orderId]
            ),
            'POST'
        );
    }
}
