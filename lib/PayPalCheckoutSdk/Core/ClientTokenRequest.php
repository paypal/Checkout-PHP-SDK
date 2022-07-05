<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpRequest;

class ClientTokenRequest extends HttpRequest
{
    public function __construct()
    {
        parent::__construct("/v1/identity/generate-token", "POST");
        $this->headers["Content-Type"] = "application/json";
    }
}
