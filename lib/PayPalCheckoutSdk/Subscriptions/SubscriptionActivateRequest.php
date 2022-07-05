<?php

namespace PayPalCheckoutSdk\Subscriptions;

use PayPalHttp\HttpRequest;

class SubscriptionActivateRequest extends HttpRequest
{
    /**
     * SubscriptionActivateRequest constructor.
     *
     * @param $body
     */
    function __construct($subscription_id, $body)
    {
        parent::__construct("/v1/billing/subscriptions/{subscription_id}/activate", "POST");
        $this->path = str_replace("{subscription_id}", urlencode($subscription_id), $this->path);
        $this->headers["Content-Type"] = "application/json";
        if(is_array($body)){
            $body  = json_encode($body);
        }
        $this->body = $body;
    }
}
