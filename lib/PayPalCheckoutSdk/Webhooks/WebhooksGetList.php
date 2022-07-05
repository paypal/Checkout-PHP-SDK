<?php

namespace PayPalCheckoutSdk\Webhooks;

use PayPalHttp\HttpRequest;

class WebhooksGetList extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/notifications/webhooks", "GET");
        $this->headers["Content-Type"] = "application/json";
    }
}
