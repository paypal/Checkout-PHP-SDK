<?php

namespace PayPalCheckoutSdk\Webhooks;

use PayPalHttp\HttpRequest;

class WebhooksPatchRequest extends HttpRequest
{
    function __construct($webhookId)
    {
        parent::__construct("/v1/notifications/webhooks/{webhook_id}?", "PATCH");

        $this->path = str_replace("{webhook_id}", urlencode($webhookId), $this->path);
        $this->headers["Content-Type"] = "application/json";
    }



}
