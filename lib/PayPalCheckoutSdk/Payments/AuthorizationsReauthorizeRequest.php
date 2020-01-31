<?php

namespace PayPalCheckoutSdk\Payments;

use PayPalCheckoutSdk\Core\Request\HeaderPreferTrait;
use PayPalCheckoutSdk\Core\Request\HeaderRequestIdTrait;

class AuthorizationsReauthorizeRequest extends AbstractPaymentsRequest
{
    use HeaderRequestIdTrait, HeaderPreferTrait;

    /**
     * @param string $authorizationId
     */
    public function __construct($authorizationId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/authorizations/{authorization_id}/reauthorize?"',
                ['authorization_id' => $authorizationId]
            ),
            'POST'
        );
    }
}
