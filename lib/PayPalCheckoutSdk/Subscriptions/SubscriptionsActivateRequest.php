<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionsActivateRequest extends HttpRequest
{
    /**
     * SubscriptionsActivateRequest constructor.
     *
     * @param $subscriptionId
     */
    function __construct($subscriptionId)
    {
        parent::__construct("/v1/billing/subscriptions/{id}/activate", "POST");
        $this->path = str_replace("{id}", urlencode($subscriptionId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }
}
