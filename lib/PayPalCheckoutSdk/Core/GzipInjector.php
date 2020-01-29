<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpRequest;
use PayPalHttp\Injector;

class GzipInjector implements Injector
{
    /**
     * @param HttpRequest $httpRequest
     */
    public function inject($httpRequest)
    {
        $httpRequest->headers['Accept-Encoding'] = 'gzip';
    }
}
