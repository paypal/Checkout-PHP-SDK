<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionsSuspendRequest extends HttpRequest
{
    /**
     * SubscriptionsSuspendRequest constructor.
     *
     * @param $subscriptionId
     */
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{id}/suspend", "POST");
        $this->path = str_replace("{id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}
