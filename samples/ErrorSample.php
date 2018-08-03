<?php

require __DIR__ . '/../vendor/autoload.php';

use CheckoutPhpsdk\Orders\OrdersCreateRequest;
use Sample\Skeleton;
use BraintreeHttp\HttpException;

class ErrorSample
{
    /**
     * Body has no required parameters (intent, purchase_units)
     */
    public static function createError1()
    {
        $request = new OrdersCreateRequest();
        $request->authorization("Bearer " . "A21AAF8VHFvjg3KakxaZ0geZbqdodpVcTci0yIqX6mbgfcEtK3nvxUvMdAgkS-Of3-QMsNSVaaLXNa02H-a6PG60Liv8vgv1g");
        $request->body = "{}";
        print "Request Body: {}\n\n";

        print "Response:\n";
        try{
            $client = Skeleton::client();
            $response = $client->execute($request);
        }
        catch(HttpException $exception){
            $message = json_decode($exception->getMessage(), true);
            print "Status Code: {$exception->statusCode}\n";
            print "Debug ID: {$message['debug_id']}\n";
            print "Details:\n";
            print "\tName: {$message['name']}\n";
            print "\tMessage: {$message['message']}\n";
            print "\tProblems:\n";
            $details = $message['details'];
            for ($i = 1; $i <= count($details); ++$i)
            {
                print "\t\t$i. Field: {$details[$i-1]["field"]}\tIssue: {$details[$i-1]["issue"]}\n";
            }
        }
    }

    /**
     * Authorization header has an empty string
     */
    public static function createError2()
    {
        $request = new OrdersCreateRequest();
        $request->authorization("");
        $request->body = json_decode('{"intent": "CAPTURE","purchase_units": [{"amount": {"currency_code":"USD","value": "100.00"}}]}', true);
        print "Request Body:\n" . json_encode($request->body, JSON_PRETTY_PRINT) . "\n\n";

        try{
            $client = Skeleton::client();
            $response = $client->execute($request);
        }
        catch(HttpException $exception){
            print "Response:\n";
            $message = json_decode($exception->getMessage(), true);
            print "Status Code: {$exception->statusCode}\n";
            print "Details:\n";
            print "\tName: {$message['name']}\n";
            print "\tMessage: {$message['message']}\n";
        }
    }

    /**
     * Body has invalid parameter value for intent
     */
    public static function createError3()
    {
        $request = new OrdersCreateRequest();
        $request->authorization("Bearer " . "A21AAF8VHFvjg3KakxaZ0geZbqdodpVcTci0yIqX6mbgfcEtK3nvxUvMdAgkS-Of3-QMsNSVaaLXNa02H-a6PG60Liv8vgv1g");
        $request->body = json_decode('{"intent": "INVALID","purchase_units": [{"amount": {"currency_code":"USD","value": "100.00"}}]}', true);
        print "Request Body:\n" . json_encode($request->body, JSON_PRETTY_PRINT) . "\n\n";

        try{
            $client = Skeleton::client();
            $response = $client->execute($request);
        }
        catch(HttpException $exception){
            print "Response:\n";
            $message = json_decode($exception->getMessage(), true);
            print "Status Code: {$exception->statusCode}\n";
            print "Details:\n";
            print "\tName: {$message['name']}\n";
            print "\tMessage: {$message['message']}\n";
            $details = $message['details'];
            for ($i = 1; $i <= count($details); ++$i)
            {
                print "\t\t$i. Field: {$details[$i-1]["field"]}\tIssue: {$details[$i-1]["issue"]}\n";
            }
        }

    }
}

print "Calling createError1 (Body has no required parameters (intent, purchase_units))\n";
ErrorSample::createError1();

print "\nCalling createError2 (Authorization header has an empty string)\n";
ErrorSample::createError2();

print "\nCalling createError3 (Body has invalid parameter value for intent)\n";
ErrorSample::createError3();
