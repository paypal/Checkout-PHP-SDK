<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionsReviseRequest extends HttpRequest
{
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{id}/revise", "POST");
        $this->path = str_replace("{id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}
