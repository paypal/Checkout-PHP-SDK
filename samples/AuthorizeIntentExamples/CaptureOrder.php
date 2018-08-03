<?php
/**
 * Created by PhpStorm.
 * User: gchockalingam
 * Date: 8/2/18
 * Time: 2:40 PM
 */

namespace Sample\AuthorizeIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';
use CheckoutPhpsdk\Payments\AuthorizationsCaptureRequest;
use Sample\Skeleton;

class CaptureOrder
{
    public static function buildRequestBody()
    {
        return "{}";
    }

    public static function captureOrder($authorizationId, $debug=false)
    {
        $request = new AuthorizationsCaptureRequest($authorizationId);
        $request->authorization("Bearer " . Skeleton::authToken());
        $request->body = self::buildRequestBody();
        $client = Skeleton::client();
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
    CaptureOrder::captureOrder('97725816T0451871L', true);
}