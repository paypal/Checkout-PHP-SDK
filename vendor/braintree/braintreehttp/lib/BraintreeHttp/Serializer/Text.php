<?php

namespace BraintreeHttp\Serializer;

use BraintreeHttp\HttpRequest;
use BraintreeHttp\Serializer;

/**
 * Class Text
 * @package BraintreeHttp\Serializer
 *
 * Serializer for Text content types.
 */
class Text implements Serializer
{

    public function contentType()
    {
        return "/^text\\/.*/";
    }

    public function encode(HttpRequest $request)
    {
        $body = $request->body;
        if (is_string($body)) {
            return $body;
        }
        if (is_array($body)) {
            return json_encode($body);
        }
        return implode(" ", $body);
    }

    public function decode($data)
    {
        return $data;
    }
}
