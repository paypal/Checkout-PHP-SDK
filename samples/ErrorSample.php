<?php

require __DIR__ . '/../vendor/autoload.php';

use CheckoutPhpsdk\Orders\OrdersCreateRequest;
use Sample\Skeleton;
use BraintreeHttp\HttpException;

class ErrorSample
{
    public static function prettyPrint($jsonData, $pre="")
    {
        $pretty = "";
        foreach ($jsonData as $key => $val)
        {
            $pretty .= $pre . ucfirst($key) .": ";
            if (strcmp(gettype($val), "array") == 0){
                $pretty .= "\n";
                $sno = 1;
                foreach ($val as $value)
                {
                    $pretty .= $pre . "\t" . $sno++ . ":\n";
                    $pretty .= self::prettyPrint($value, $pre . "\t\t");
                }
            }
            else {
                $pretty .= $val . "\n";
            }
        }
        return $pretty;
    }

    /**
     * Body has no required parameters (intent, purchase_units)
     */
    public static function createError1()
    {
        $request = new OrdersCreateRequest();
        $request->authorization("Bearer " . Skeleton::authToken());
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
            print(self::prettyPrint($message));
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
            print(self::prettyPrint($message));
        }
    }

    /**
     * Body has invalid parameter value for intent
     */
    public static function createError3()
    {
        $request = new OrdersCreateRequest();
        $request->authorization("Bearer " . Skeleton::authToken());
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
            print(self::prettyPrint($message));
        }

    }
}

print "Calling createError1 (Body has no required parameters (intent, purchase_units))\n";
ErrorSample::createError1();

print "\n\nCalling createError2 (Authorization header has an empty string)\n";
ErrorSample::createError2();

print "\n\nCalling createError3 (Body has invalid parameter value for intent)\n";
ErrorSample::createError3();
