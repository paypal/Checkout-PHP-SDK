<?php

namespace Sample\CaptureIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';

use CheckoutPhpsdk\Orders\OrdersCreateRequest;
use Sample\Skeleton;

class CreateOrder
{
    private static function buildRequestBody()
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

    public static function createOrder($debug=false)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->authorization("Bearer " . "A21AAF8VHFvjg3KakxaZ0geZbqdodpVcTci0yIqX6mbgfcEtK3nvxUvMdAgkS-Of3-QMsNSVaaLXNa02H-a6PG60Liv8vgv1g");
        $request->body = self::buildRequestBody();

        $client = Skeleton::client();
        $response = $client->execute($request);
        if ($debug)
        {
            print "Status Code: {$response->statusCode}\n";
            print "Status: {$response->result->status}\n";
            print "Order ID: {$response->result->id}\n";
            print "Intent: {$response->result->intent}\n";
            print "Links:\n";
            foreach($response->result->links as $link)
            {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            print "\nActual Response Body:\n";
            echo json_encode($response->result, JSON_PRETTY_PRINT);
        }


        return $response;
    }
}



if (!count(debug_backtrace()))
{
    CreateOrder::createOrder(true);
}



