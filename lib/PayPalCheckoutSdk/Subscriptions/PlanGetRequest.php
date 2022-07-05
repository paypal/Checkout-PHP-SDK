<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class PlanGetRequest extends HttpRequest
{
    function __construct($planId)
    {
        parent::__construct("/v1/billing/plans/{id}", "GET");
        $this->path = str_replace("{id}", urlencode($planId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}
