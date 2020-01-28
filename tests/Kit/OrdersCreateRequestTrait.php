<?php

namespace Test\Kit;

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpClient;
use PayPalHttp\HttpResponse;

trait OrdersCreateRequestTrait
{

    /**
     * @return array
     */
    private function buildRequestBodyForOrdersCreateRequest()
    {
        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => 'test_ref_id1',
                    'amount' => [
                        'value' => '100.00',
                        'currency_code' => 'USD',
                    ],
                ],
            ],
            'redirect_urls' => [
                'cancel_url' => 'https://example.com/cancel',
                'return_url' => 'https://example.com/return',
            ],
        ];
    }

    /**
     * @param HttpClient $client
     *
     * @return HttpResponse
     */
    protected function createOrdersCreateRequest($client) {
        $request = new OrdersCreateRequest();
        $request->prefer("return=representation");
        $request->body = $this->buildRequestBodyForOrdersCreateRequest();

        return $client->execute($request);
    }
}
