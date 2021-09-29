<?php

namespace PayPalCheckoutSdk\Setup;

use PayPalCheckoutSdk\Core\AuthorizationInjector;
use PayPalCheckoutSdk\Core\FPTIInstrumentationInjector;
use PayPalCheckoutSdk\Core\GzipInjector;
use PayPalCheckoutSdk\Core\PayPalEnvironment;
use PayPalCheckoutSdk\Core\UserAgent;
use PayPalHttp\HttpClient;

class PayPalHttpClient extends HttpClient
{
    public $authInjector;

    /** @var PayPalEnvironment */
    public $paypalEnvironment;

    public function __construct(PayPalEnvironment $environment)
    {
        parent::__construct($environment);
        $this->paypalEnvironment = $environment;
        $this->authInjector = new AuthorizationInjector($this, $environment);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
    }

    public function userAgent()
    {
        return UserAgent::getValue();
    }
}

