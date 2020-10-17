<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpClient;

class PayPalHttpClient extends HttpClient
{
    /**
     * @var string|null
     */
    private $refreshToken;

    /**
     * @var AuthorizationInjector
     */
    public $authInjector;

    /**
     * @param PayPalEnvironment $environment
     * @param string|null       $refreshToken
     */
    public function __construct(PayPalEnvironment $environment, $refreshToken = null)
    {
        parent::__construct($environment);

        $this->refreshToken = $refreshToken;
        $this->authInjector = new AuthorizationInjector($this, $environment, $refreshToken);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
    }

    /**
     * @return string
     */
    public function userAgent()
    {
        return UserAgent::getValue();
    }
}
