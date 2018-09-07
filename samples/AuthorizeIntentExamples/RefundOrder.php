<?php

namespace Sample\AuthorizeIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';
use CheckoutPhpsdk\Payments\CapturesRefundRequest;
use Sample\SampleSkeleton;

class RefundOrder
{
    public static function buildRequestBody()
    {
        return "{}";
    }

    public static function refundOrder($captureId, $debug=false)
    {
        $request = new CapturesRefundRequest($captureId);
        $request->body = self::buildRequestBody();
        $client = SampleSkeleton::client();
        $response = $client->execute($request);

        if ($debug)
        {
            print "Status Code: {$response->statusCode}\n";
            print "Status: {$response->result->status}\n";
            print "Order ID: {$response->result->id}\n";
            print "Links:\n";
            foreach($response->result->links as $link)
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
    RefundOrder::refundOrder('4K037715F5936332E', true);
}