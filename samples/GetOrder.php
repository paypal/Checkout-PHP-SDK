<?php

namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use CheckoutPhpsdk\Orders\OrdersGetRequest;
use Sample\AuthorizeIntentExamples\CreateOrder;

class GetOrder
{
    public static function getOrder()
    {
        $createdOrder = CreateOrder::createOrder()->result;
        $client = SampleSkeleton::client();

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

        // To print the whole response body uncomment below line
        // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }
}

if (!count(debug_backtrace()))
{
    GetOrder::getOrder();
}