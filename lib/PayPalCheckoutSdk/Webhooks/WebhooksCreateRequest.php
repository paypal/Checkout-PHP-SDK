<?php

namespace PayPalCheckoutSdk\Webhooks;

use PayPalHttp\HttpRequest;

class WebhooksCreateRequest extends HttpRequest
{
    function __construct( $body )
    {
        parent::__construct("/v1/notifications/webhooks", "POST");
        $this->headers["Content-Type"] = "application/json";
        if(is_array($body)){
            $body  = json_encode($body);
        }
        $this->body = $body;
    }
}
