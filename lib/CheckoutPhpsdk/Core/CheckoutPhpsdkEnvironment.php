<?php

namespace CheckoutPhpsdk\Core;

use BraintreeHttp\Environment;

class CheckoutPhpsdkEnvironment implements Environment 
{
    public function baseUrl()
    {
        throw new Exception("Not implemented");
    }
}
