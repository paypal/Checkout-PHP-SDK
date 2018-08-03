<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersGetRequest;
use Test\TestHarness;


class OrdersGetTest extends TestCase
{

    public function testOrdersGetRequest()
    {
        $request = new OrdersGetRequest('i08Lu2vQaSPJ');

        $client = TestHarness::client();
        $response = $client->execute($request);
        $this->assertEquals(200, $response->statusCode);
        $this->assertNotNull($response->result);

        // Add your own checks here
    }
}
