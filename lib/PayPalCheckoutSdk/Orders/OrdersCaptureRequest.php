<?php

namespace PayPalCheckoutSdk\Orders;

use PayPalCheckoutSdk\Core\Request\HeaderClientMetadataIdTrait;
use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;
use PayPalCheckoutSdk\Core\Request\HeaderRequestIdTrait;

class OrdersCaptureRequest extends AbstractOrdersRequest
{
    use HeaderRequestIdTrait, HeaderPreferTrait, HeaderClientMetadataIdTrait;

    /**
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/{order_id}/capture?',
                ['order_id' => $orderId]
            ),
            'POST'
        );
    }
}
