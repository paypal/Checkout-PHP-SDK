<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersCaptureRequest;
use Test\TestHarness;


class OrdersCaptureTest extends TestCase
{
    private function buildRequestBody()
    {
        return json_decode('{"payment_source":{"card":{"last_digits":"yGV5qHahOzr7b","name":"VJT004OYeJ4sEL ","number":"sPs wXSz7PW","security_code":"yWx1GdVVc8B Zg1IHBh","billing_address":{"admin_area_4":"zBVz0h8vdZSq","postal_code":"BuMOZ835VTEc","address_details":{"delivery_service":"yaLH57HpvfF bZ2","street_name":"Spb5RQ5hCg","street_number":"pI9cZGDrOSydCTs","street_type":"MfHpXJCbDs qP","sub_building":"WES3UHaVOSxSu0qV7x ","building_name":"E9vXSZpt7UAHJaGaV8G"},"admin_area_1":"bcOq0ppJqg","admin_area_2":"6eZDpU 3hy7Wqe","admin_area_3":"0hLHwMLcKqsAB6g8L","address_line_1":"A3QhpxG1tvbGzhb","address_line_2":"BigX2 JSRTtw2I","address_line_3":"36ycxvHv s4QN883I0z","country_code":"F3qq9tzy4sRFSa"},"card_type":"NIV9KNCVhfb2GHf","expiry":"96wW7SMQyFzyKsuL","id":"S5Mw0UX8dbpKEV9c"},"token":{"id":"5ZNtuDsO5vOcf2aQ","type":" v1ZbGY6E3iCOAV"}}}', true);
    }

    public function testOrdersCaptureRequest()
    {
        $request = new OrdersCaptureRequest('xC Sy1zBdNzr8');
        $request->payPalClientMetadataId('ZSSBw7ys3i9gsYEUz');
        $request->payPalRequestId('FYMabvNfMsAxwURx');
        $request->prefer('sc3hFutqK8Uh5');
        $request->body = $this->buildRequestBody();

        $client = TestHarness::client();
        $response = $client->execute($request);
        $this->assertEquals(201, $response->statusCode);
        $this->assertNotNull($response->result);

        // Add your own checks here
    }
}
