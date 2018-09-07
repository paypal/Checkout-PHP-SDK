<?php

namespace Sample\AuthorizeIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';
use CheckoutPhpsdk\Orders\OrdersAuthorizeRequest;
use Sample\SampleSkeleton;


class AuthorizeOrder
{
    public static function buildRequestBody()
    {
        return "{}";
    }
    public static function authorizeOrder($orderId, $debug=false)
    {
        $request = new OrdersAuthorizeRequest($orderId);
        $request->body = self::buildRequestBody();

        $client = SampleSkeleton::client();
        $response = $client->execute($request);
        if ($debug)
        {
            print "Status Code: {$response->statusCode}\n";
            print "Status: {$response->result->status}\n";
            print "Order ID: {$response->result->id}\n";
            print "Authorization ID: {$response->result->purchase_units[0]->payments->authorizations[0]->id}\n";
            print "Links:\n";
            foreach($response->result->links as $link)
            {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            print "Authorization Links:\n";
            foreach($response->result->purchase_units[0]->payments->authorizations[0]->links as $link)
            {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To print the whole response body uncomment below line
            // echo json_encode($response->result, JSON_PRETTY_PRINT);
        }
        return $response;
    }
}

if (!count(debug_backtrace()))
{
    AuthorizeOrder::authorizeOrder('1U242387CB956380X', true);
}