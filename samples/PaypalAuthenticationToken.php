<?php
/**
 * Created by PhpStorm.
 * User: gchockalingam
 * Date: 8/2/18
 * Time: 4:57 PM
 */


namespace Sample;

require __DIR__ . '/../vendor/autoload.php';
use BraintreeHttp\HttpRequest;

class PaypalAuthenticationToken extends HttpRequest
{
    function __construct()
    {
        parent::__construct("/v1/oauth2/token", "POST");
        $this->body = json_decode('{"grant_type": "client_credentials"}', true);
        $this->headers["Content-Type"] = "application/x-www-form-urlencoded";
    }

    public function credentials($username, $password){
        $this->headers["Authorization"] = "Basic " . base64_encode($username . ":" . $password);
    }
}