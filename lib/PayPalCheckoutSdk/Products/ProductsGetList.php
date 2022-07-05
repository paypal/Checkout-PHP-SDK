<?php

namespace PayPalCheckoutSdk\Products;

use PayPalHttp\HttpRequest;

class ProductsGetList extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/catalogs/products", "GET");
        $this->headers["Content-Type"] = "application/json";
    }
}
