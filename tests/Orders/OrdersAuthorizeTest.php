<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersAuthorizeRequest;
use Test\TestHarness;


class OrdersAuthorizeTest extends TestCase
{
    private function buildRequestBody()
    {
        return json_decode('{"payment_source":{"card":{"billing_address":{"admin_area_3":"AuddzvaQZf4","address_line_1":"V1KS965FGa43s","address_line_2":"Qqq1xsKFIi8cEb4","admin_area_2":"ABGSTgyDThycBY7cv2","admin_area_4":"9YVtvpdvQe1Js","country_code":"Tb3Tpspgr0","postal_code":"bTcBGFB0XY5r4sYZs","address_details":{"sub_building":"Tyd8Vqu Wg3Q","building_name":"BAZav3u9xg8Z9","delivery_service":"aiZA6HZfi2T2qz","street_name":"I2Odg KZdHPM","street_number":"S2gGPh5f88xe5CwGY8v","street_type":"64OyyrMaY3fcPN"},"address_line_3":"BY0v9xD4QupEQ","admin_area_1":"22c 8YWBzeVV8"},"card_type":"7ieyVNw3Tv8","expiry":"qbZXtTb0z3fh","id":"abXXO J622bAMGBQRf","last_digits":"yRv8HbDH8BE9","name":" ORvqMgT3PHHwN2h9","number":"6TPXsVdUAupQQDZRN2x","security_code":"NcTFcZJhcK"},"token":{"id":"r0MrQepRvfpH","type":"4B4gaTD0ae"}}}', true);
    }

    public function testOrdersAuthorizeRequest()
    {
        $request = new OrdersAuthorizeRequest('9sit4ctZ9cv');
        $request->payPalClientMetadataId('KBJr0idM9Z2xZ');
        $request->payPalRequestId('CvzCTaXpZ87Z6zqVB5');
        $request->prefer('Ydtxh4yKR2s7RA6usb9');
        $request->body = $this->buildRequestBody();

        $client = TestHarness::client();
        $response = $client->execute($request);
        $this->assertEquals(201, $response->statusCode);
        $this->assertNotNull($response->result);

        // Add your own checks here
    }
}
