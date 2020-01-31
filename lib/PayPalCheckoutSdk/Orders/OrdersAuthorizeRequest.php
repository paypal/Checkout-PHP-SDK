<?php

namespace PayPalCheckoutSdk\Orders;

use PayPalCheckoutSdk\Core\Request\HeaderClientMetadataIdTrait;
use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;
use PayPalCheckoutSdk\Core\Request\HeaderRequestIdTrait;

class OrdersAuthorizeRequest extends AbstractOrdersRequest
{
    use HeaderRequestIdTrait, HeaderPreferTrait, HeaderClientMetadataIdTrait;

    /**
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/{order_id}/authorize?',
                ['order_id' => $orderId]
            ),
            'POST'
        );
    }
}
