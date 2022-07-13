<?php

namespace PayPalCheckoutSdk\Webhooks;

use PayPalHttp\HttpRequest;

class WebhooksDeleteRequest extends HttpRequest
{
    function __construct($webhookId)
    {
        parent::__construct("/v1/notifications/webhooks/{webhook_id}", "DELETE");
        $this->headers["Content-Type"] = "application/json";
    }



}
