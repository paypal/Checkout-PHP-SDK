<?php

namespace Test\Integration\Orders;

use PayPalCheckoutSdk\Orders\OrdersAuthorizeRequest;
use Test\IntegrationTestCase;

class OrdersAuthorizeRequestTest extends IntegrationTestCase
{
    /**
     * testOrdersAuthorizeRequest
     */
    public function testOrdersAuthorizeRequest()
    {
        $this->markTestSkipped("Need an approved Order ID to execute this test.");
        $request = new OrdersAuthorizeRequest('ORDER-ID');
        $request->body = $this->buildRequestBody();

        $response = $this->client->execute($request);
        $this->assertEquals(201, $response->statusCode);
        $this->assertNotNull($response->result);
    }
}
