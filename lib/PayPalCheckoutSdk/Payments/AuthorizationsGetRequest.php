<?php

namespace PayPalCheckoutSdk\Payments;

class AuthorizationsGetRequest extends AbstractPaymentsRequest
{
    /**
     * @param string $authorizationId
     */
    public function __construct($authorizationId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/authorizations/{authorization_id}?"',
                ['authorization_id' => $authorizationId]
            ),
            'GET'
        );
    }
}
