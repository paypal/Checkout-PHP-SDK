<?php


namespace Sample\CaptureIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';
use CheckoutPhpsdk\Orders\OrdersCaptureRequest;
use Sample\SampleSkeleton;

class CaptureOrder
{
    public static function captureOrder($orderId, $debug=false)
    {
        $request = new OrdersCaptureRequest($orderId);

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
            print "\nActual Response Body:\n";
            echo json_encode($response->result, JSON_PRETTY_PRINT);
        }

        return $response;
    }
}

if (!count(debug_backtrace()))
{
    CaptureOrder::captureOrder('71551735D5901444A', true);
}