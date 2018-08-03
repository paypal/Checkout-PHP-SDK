<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersValidateRequest;
use Test\TestHarness;


class OrdersValidateTest extends TestCase
{
    private function buildRequestBody()
    {
        return json_decode('{"payment_source":{"card":{"expiry":"6FePGfOGbAEMd","id":"OrDPhVuXKpXHH9Qz","last_digits":"0KOIXIEHMy8XQ","name":"9zLY2OcXZT901MM","number":"UHWv091J8uNBT","security_code":"96sOPRvUZGqaVxqT6","billing_address":{"address_line_2":"XUfyBNWuLYF8","address_line_3":"AUTU4JrGaWg7X","admin_area_2":"Y4fMctNES RRXt","postal_code":"9i2Fg775x1TvqwOgKy","address_details":{"delivery_service":"g9ttrsAA8p","street_name":"wQVF8VYBHgTy","street_number":"J7Rb75iENi9V","street_type":"s65T 58VtNVP0 2FUM6","sub_building":"syiRIzEJ5Ic vf6bqsb","building_name":"SRvGddJ9A2Tpt4c"},"admin_area_1":"c5W4wK4xDE3wG","admin_area_3":"A61evI2gph2","admin_area_4":"cRRSqLsGvQV8f5G","country_code":"0I YHh5Np128G","address_line_1":"78SQMfy9Zt Pgdv3yt"},"card_type":"Dvp8ZQh12wM"},"token":{"id":"VS6W6NbVuACcghEh","type":"73MTJUYzIMpQfIdV"}}}', true);
    }

    public function testOrdersValidateRequest()
    {
        $request = new OrdersValidateRequest('H3R9bCfwSqD7');
        $request->payPalClientMetadataId('vB4WxxIawArRdc');
        $request->body = $this->buildRequestBody();

        $client = TestHarness::client();
        $response = $client->execute($request);
        $this->assertEquals(200, $response->statusCode);
        $this->assertNotNull($response->result);

        // Add your own checks here
    }
}
