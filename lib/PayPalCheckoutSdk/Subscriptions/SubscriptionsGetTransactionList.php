<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionsGetTransactionList extends HttpRequest
{
    function __construct($subscription_id, $parameters)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}/transactions?", "GET");
        $this->path = str_replace("{subscription_id}", urlencode($subscription_id), $this->path);
        $this->path .='&'.http_build_query($parameters);
        $this->headers["Content-Type"] = "application/json";
        $this->body = $parameters;
    }
}