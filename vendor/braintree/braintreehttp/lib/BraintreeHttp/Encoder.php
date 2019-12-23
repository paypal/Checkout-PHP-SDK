<?php

namespace BraintreeHttp;

use BraintreeHttp\Serializer\Form;
use BraintreeHttp\Serializer\Json;
use BraintreeHttp\Serializer\Multipart;
use BraintreeHttp\Serializer\Text;

/**
 * Class Encoder
 * @package BraintreeHttp
 *
 * Encoding class for serializing and deserializing request/response.
 */
class Encoder
{
    private $serializers = [];

    function __construct()
    {
        $this->serializers[] = new Json();
        $this->serializers[] = new Text();
        $this->serializers[] = new Multipart();
        $this->serializers[] = new Form();
    }

    public function serializeRequest(HttpRequest $request)
    {
        if (!array_key_exists('Content-Type', $request->headers)) {
            throw new \Exception("HttpRequest does not have Content-Type header set");
        }

        $contentType = $request->headers['Content-Type'];
        /** @var Serializer $serializer */
        $serializer = $this->serializer($contentType);

        if (is_null($serializer)) {
            throw new \Exception(sprintf("Unable to serialize request with Content-Type: %s. Supported encodings are: %s", $contentType, implode(", ", $this->supportedEncodings())));
        }

        if (!(is_string($request->body) || is_array($request->body))) {
            throw new \Exception(sprintf("Body must be either string or array"));
        }

        $serialized = $serializer->encode($request);

        if (array_key_exists("Content-Encoding", $request->headers) && $request->headers["Content-Encoding"] === "gzip") {
            $serialized = gzencode($serialized);
        }

        return $serialized;
    }

    public function deserializeResponse($responseBody, $headers)
    {
        if (!array_key_exists('Content-Type', $headers)) {
            throw new \Exception("HTTP response does not have Content-Type header set");
        }

        $contentType = $headers['Content-Type'];
        /** @var Serializer $serializer */
        $serializer = $this->serializer($contentType);

        if (is_null($serializer)) {
            throw new \Exception(sprintf("Unable to deserialize response with Content-Type: %s. Supported encodings are: %s", $contentType, implode(", ", $this->supportedEncodings())));
        }

        if (array_key_exists("Content-Encoding", $headers) && $headers["Content-Encoding"] === "gzip") {
            $responseBody = gzdecode($responseBody);
        }

        return $serializer->decode($responseBody);
    }

    private function serializer($contentType)
    {
        /** @var Serializer $serializer */
        foreach ($this->serializers as $serializer) {
            try {
                if (preg_match($serializer->contentType(), $contentType) == 1) {
                    return $serializer;
                }
            } catch (\Exception $ex) {
                throw new \Exception(sprintf("Error while checking content type of %s: %s", get_class($serializer), $ex->getMessage()), $ex->getCode(), $ex);
            }
        }

        return NULL;
    }

    private function supportedEncodings()
    {
        $values = [];
        /** @var Serializer $serializer */
        foreach ($this->serializers as $serializer) {
            $values[] = $serializer->contentType();
        }
        return $values;
    }
}
