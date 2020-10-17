<?php

namespace PayPalCheckoutSdk\Payments;

class AuthorizationsVoidRequest extends AbstractPaymentsRequest
{
    /**
     * @param string $authorizationId
     */
    public function __construct($authorizationId)
    {
        parent::__construct(
            $this->buildPathWithPlaceholders(
                '/authorizations/{authorization_id}/void?"',
                ['authorization_id' => $authorizationId]
            ),
            'POST'
        );
    }
}
