<?php



namespace Test\CheckoutPhpsdk\Orders;

use PHPUnit\Framework\TestCase;

use CheckoutPhpsdk\Orders\OrdersCreateRequest;
use Test\TestHarness;


class OrdersCreateTest extends TestCase
{
    private function buildRequestBody()
    {
        return json_decode('{
          "intent": "CAPTURE",
          "application_context": {
            "return_url": "https://example.com/return",
            "cancel_url": "https://example.com/cancel",
            "brand_name": "EXAMPLE INC",
            "locale": "de-DE",
            "landing_page": "BILLING",
            "shipping_preferences": "SET_PROVIDED_ADDRESS",
            "user_action": "PAY_NOW"
          },
          "purchase_units": [
            {
              "reference_id": "PUHF",
              "description": "Sporting Goods",
              "custom_id": "CUST-HighFashions",
              "invoice_id": "INV-HighFashions",
              "soft_descriptor": "HighFashions",
              "amount": {
                "currency_code": "USD",
                "value": "220.00",
                "breakdown": {
                  "item_total": {
                    "currency_code": "USD",
                    "value": "180.00"
                  },
                  "shipping": {
                    "currency_code": "USD",
                    "value": "20.00"
                  },
                  "handling": {
                    "currency_code": "USD",
                    "value": "10.00"
                  },
                  "tax_total": {
                    "currency_code": "USD",
                    "value": "20.00"
                  },
                  "shipping_discount": {
                    "currency_code": "USD",
                    "value": "10.00"
                  }
                }
              },
              "payee": {
                "email_address": "rpenmetsa-us@paypal.com"
              },
              "items": [
                {
                  "name": "T-Shirt",
                  "description": "Green XL",
                  "sku": "sku01",
                  "unit_amount": {
                    "currency_code": "USD",
                    "value": "90.00"
                  },
                  "tax": {
                    "currency_code": "USD",
                    "value": "10.00"
                  },
                  "quantity": "1",
                  "category": "PHYSICAL_GOODS"
                },
                {
                  "name": "Shoes",
                  "description": "Running, Size 10.5",
                  "sku": "sku02",
                  "unit_amount": {
                    "currency_code": "USD",
                    "value": "45.00"
                  },
                  "tax": {
                    "currency_code": "USD",
                    "value": "5.00"
                  },
                  "quantity": "2",
                  "category": "PHYSICAL_GOODS"
                }
              ],
              "shipping": {
                "method": "United States Postal Service",
                "address": {
                  "address_line_1": "123 Townsend St",
                  "address_line_2": "Floor 6",
                  "admin_area_2": "San Francisco",
                  "admin_area_1": "CA",
                  "postal_code": "94107",
                  "country_code": "US"
                }
              }
            }
          ]
        }', true);
    }

    public function testOrdersCreateRequest()
    {
        $request = new OrdersCreateRequest();
//        $request->payPalPartnerAttributionId('KG2 eV4rrSNGt6yv');
        $request->prefer('return=representation');
        $request->authorization("Bearer " . "A21AAGiDgbci03eOeUJl8bHxFGHn5MKt232TljCDQbRu_gCc4Oz4eOsDA9yeeLtyMFgk1YihMr4szrVNz4T9jP33TmnVydrUw");
        $request->body = $this->buildRequestBody();

        $client = TestHarness::client();
        $response = $client->execute($request);
        printf(json_encode($response->result->purchase_units));
//        $this->assertEquals(201, $response->statusCode);
//        $this->assertNotNull($response->result);

        // Add your own checks here
    }
}
