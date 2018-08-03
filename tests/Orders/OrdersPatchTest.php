<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersPatchRequest;
use Test\TestHarness;


class OrdersPatchTest extends TestCase
{
    private function buildRequestBody()
    {
        return json_decode('{"from":"Ipg1yWM8pfP","op":"XUeCM9vJe7cLUd","path":"L4QcOSeYpcr","value":{}}', true);
    }

    public function testOrdersPatchRequest()
    {
        $request = new OrdersPatchRequest('Ng UixzaP4ZGcFPIHc');
        $request->body = $this->buildRequestBody();

        $client = TestHarness::client();
        $response = $client->execute($request);
        $this->assertEquals(204, $response->statusCode);

        // Add your own checks here
    }
}
