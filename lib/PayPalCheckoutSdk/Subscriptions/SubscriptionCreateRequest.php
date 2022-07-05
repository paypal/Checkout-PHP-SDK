<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionCreateRequest extends HttpRequest
{
    /**
     * SubscriptionCreateRequest constructor.
     *
     * @param $body
     */
    function __construct($body)
    {
        parent::__construct("/v1/billing/subscriptions", "POST");
        $this->headers["Content-Type"] = "application/json";
        if(is_array($body)){
            $body  = json_encode($body);
        }
        $this->body = $body;
    }
}
