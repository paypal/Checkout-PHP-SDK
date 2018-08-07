<?php

namespace Sample;

//require __DIR__ . '/../vendor/autoload.php';
use CheckoutPhpsdk\Core\CheckoutPhpsdkHttpClient;
use CheckoutPhpsdk\Core\CheckoutPhpsdkEnvironment;
//use Sample\PaypalAuthenticationToken;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class Skeleton
{

    public static function client()
    {
        $environment = new CheckoutPhpsdkEnvironment();
        return new CheckoutPhpsdkHttpClient($environment);
    }
    public static function authToken(){
        $client_id = "AVNCVvV9oQ7qee5O8OW4LSngEeU1dI7lJAGCk91E_bjrXF2LXB2TK2ICXQuGtpcYSqs4mz1BMNQWuso1";
        $client_password = "EDQzd81k-1z2thZw6typSPOTEjxC_QbJh6IithFQuXdRFc7BjVht5rQapPiTaFt5RC-HCa1ir6mi-H5l";
        $authorization = new PaypalAuthenticationToken();
        $authorization->credentials($client_id, $client_password);
        $client = self::client();
        $response = $client->execute($authorization);
        return $response->result->access_token;
    }
}