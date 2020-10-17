<?php

namespace PayPalCheckoutSdk\Orders;

use PayPalCheckoutSdk\Core\Request\HeaderPartnerAttributionIdTrait;
use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;

class OrdersCreateRequest extends AbstractOrdersRequest
{
    use HeaderPartnerAttributionIdTrait, HeaderPreferTrait;

    public function __construct()
    {
        parent::__construct('?', 'POST');
    }
}
