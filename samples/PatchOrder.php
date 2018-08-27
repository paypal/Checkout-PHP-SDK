<?php

namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use CheckoutPhpsdk\Orders\OrdersPatchRequest;
use CheckoutPhpsdk\Orders\OrdersGetRequest;
use Sample\AuthorizeIntentExamples\CreateOrder;

class PatchOrder
{
    private static function buildRequestBody()
    {
        return array (
            0 =>
                array (
                    'op' => 'replace',
                    'path' => '/intent',
                    'value' => 'CAPTURE',
                ),
            1 =>
                array (
                    'op' => 'replace',
                    'path' => '/purchase_units/@reference_id==\'PUHF\'/amount',
                    'value' =>
                        array (
                            'currency_code' => 'USD',
                            'value' => '200.00',
                            'breakdown' =>
                                array (
                                    'item_total' =>
                                        array (
                                            'currency_code' => 'USD',
                                            'value' => '180.00',
                                        ),
                                    'tax_total' =>
                                        array (
                                            'currency_code' => 'USD',
                                            'value' => '20.00',
                                        ),
                                ),
                        ),
                ),
        );
    }

    public static function patchOrder()
    {
        print "Before PATCH:\n";
        $createdOrder = CreateOrder::createOrder(true)->result;
        $client = SampleSkeleton::client();

        $request = new OrdersPatchRequest($createdOrder->id);
        $request->body = PatchOrder::buildRequestBody();
        $client->execute($request);
        print "\nAfter PATCH (Changed Intent and Amount):\n";
        $response = $client->execute(new OrdersGetRequest($createdOrder->id));

        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach($response->result->links as $link)
        {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }

        print "Gross Amount: {$response->result->gross_amount->currency_code} {$response->result->gross_amount->value}\n";
    }
}

if (!count(debug_backtrace()))
{
    PatchOrder::patchOrder();
}