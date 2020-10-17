<?php

namespace Test;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PHPUnit\Framework\TestCase;

class IntegrationTestCase extends TestCase
{
    /**
     * @var PayPalHttpClient
     */
    protected $client;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->client = $this->initClient();

        parent::setUp();
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->client = null;

        parent::tearDown();
    }

    /**
     * @return PayPalHttpClient
     */
    protected function initClient()
    {
        return new PayPalHttpClient($this->createSandboxEnvironment());
    }

    /**
     * @return SandboxEnvironment
     */
    private function createSandboxEnvironment()
    {
        $clientId = getenv('CLIENT_ID') ?: '<<PAYPAL-CLIENT-ID>>';
        $clientSecret = getenv('CLIENT_SECRET') ?: '<<PAYPAL-CLIENT-SECRET>>';

        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
