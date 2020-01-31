<?php

namespace PayPalCheckoutSdk\Payments;

use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;
use PayPalCheckoutSdk\Core\Request\HeaderRequestIdTrait;

class AuthorizationsCaptureRequest extends AbstractPaymentsRequest
{
    use HeaderRequestIdTrait, HeaderPreferTrait;

    /**
     * @param string $authorizationId
     */
    public function __construct($authorizationId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/authorizations/{authorization_id}/capture?"',
                ['authorization_id' => $authorizationId]
            ),
            'POST'
        );
    }
}
