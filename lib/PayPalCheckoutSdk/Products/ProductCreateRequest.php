<?php

namespace PayPalCheckoutSdk\Products;

use PayPalHttp\HttpRequest;

class ProductCreateRequest extends HttpRequest
{
    function __construct( $body )
    {
        parent::__construct("/v1/catalogs/products", "POST");
        $this->headers["Content-Type"] = "application/json";
        if(is_array($body)){
            $body  = json_encode($body);
        }
        $this->body = $body;
    }
}
