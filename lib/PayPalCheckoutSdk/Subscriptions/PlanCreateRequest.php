<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class PlanCreateRequest extends HttpRequest
{
    /**
     * PlanCreateRequest constructor.
     *
     * @param $body
     */
    function __construct($body)
    {
        parent::__construct("/v1/billing/plans?", "POST");
        $this->headers["Content-Type"] = "application/json";
        if(is_array($body)){
            $body  = json_encode($body);
        }
        $this->body = $body;
    }
}
