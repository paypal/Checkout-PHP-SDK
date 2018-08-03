<?php

namespace Test;

use CheckoutPhpsdk\Core\CheckoutPhpsdkHttpClient;
use BraintreeHttp\Environment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class TestEnvironment implements Environment
{
    public function baseUrl()
    {
        return getenv("BASE_URL");
    }
}

class TestHarness
{
    public static function client()
    {
        $environment = new TestEnvironment();
        return new CheckoutPhpsdkHttpClient($environment);
    }
}
