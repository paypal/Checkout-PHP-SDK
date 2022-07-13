<?php

namespace PayPalCheckoutSdk\Webhooks;

use PayPalHttp\HttpRequest;

class WebhooksDeleteRequest extends HttpRequest
{
    function __construct($webhookId)
    {
        parent::__construct("/v1/notifications/webhooks/".$webhookId, "DELETE");
        $this->headers["Content-Type"] = "application/json";
    }



}
