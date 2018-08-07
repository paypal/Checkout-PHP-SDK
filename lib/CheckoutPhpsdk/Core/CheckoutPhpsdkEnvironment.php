<?php

namespace CheckoutPhpsdk\Core;

use BraintreeHttp\Environment;

class CheckoutPhpsdkEnvironment implements Environment 
{
    public function baseUrl()
    {
        return getenv('BASE_URL');
    }
}
