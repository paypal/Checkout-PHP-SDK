<?php

namespace Test\Integration\Orders;

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Test\IntegrationTestCase;

class OrdersCaptureRequestTest extends IntegrationTestCase
{
    /**
     * testOrdersCaptureRequest
     */
    public function testOrdersCaptureRequest()
    {
        $this->markTestSkipped("Need an approved Order ID to execute this test.");
        $request = new OrdersCaptureRequest('ORDER-ID');

        $response = $this->client->execute($request);
        $this->assertEquals(201, $response->statusCode);
        $this->assertNotNull($response->result);
    }
}
