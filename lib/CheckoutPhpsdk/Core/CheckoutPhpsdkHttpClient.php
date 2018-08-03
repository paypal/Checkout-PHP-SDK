<?php

namespace CheckoutPhpsdk\Core;

use BraintreeHttp\Environment;
use BraintreeHttp\HttpRequest;
use BraintreeHttp\HttpClient;

class CheckoutPhpsdkHttpClient extends HttpClient
{
    public function __construct(Environment $environment)
    {
        parent::__construct($environment);
    }

    public function userAgent() 
    {
        return "CheckoutPHPSDK HttpClient";
    }
}
