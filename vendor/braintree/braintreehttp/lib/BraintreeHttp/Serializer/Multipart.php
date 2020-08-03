<?php

namespace BraintreeHttp\Serializer;

use finfo;
use BraintreeHttp\HttpRequest;
use BraintreeHttp\Serializer;
use BraintreeHttp\Encoder;
use BraintreeHttp\Serializer\FormPart;

/**
 * Class Multipart
 * @package BraintreeHttp\Serializer
 *
 * Serializer for multipart.
 */
class Multipart implements Serializer
{
    const LINEFEED = "\r\n";

    public function contentType()
    {
        return "/^multipart\/.*$/";
    }

    public function encode(HttpRequest $request)
    {
        if (!is_array($request->body) || !$this->isAssociative($request->body))
        {
            throw new \Exception("HttpRequest body must be an associative array when Content-Type is: " . $request->headers["Content-Type"]);
        }

        $boundary = "---------------------" . md5(mt_rand() . microtime());
        $contentTypeHeader = $request->headers["Content-Type"];
        $request->headers["Content-Type"] = "{$contentTypeHeader}; boundary={$boundary}";

        $value_params = [];
        $file_params = [];

        $disallow = ["\0", "\"", "\r", "\n"];

        $body = [];

        foreach ($request->body as $k => $v) {
            $k = str_replace($disallow, "_", $k);
            if (is_resource($v)) {
                $file_params[] = $this->prepareFilePart($k, $v, $boundary);
            } else if ($v instanceof FormPart) {
                $value_params[] = $this->prepareFormPart($k, $v, $boundary);
            } else {
                $value_params[] = $this->prepareFormField($k, $v, $boundary);
            }
        }

        $body = array_merge($value_params, $file_params);

        // add boundary for each parameters
        array_walk($body, function (&$part) use ($boundary) {
            $part = "--{$boundary}" . self::LINEFEED . "{$part}";
        });

        // add final boundary
        $body[] = "--{$boundary}--";
        $body[] = "";

        return implode(self::LINEFEED, $body);
    }

    public function decode($data)
    {
        throw new \Exception("Multipart does not support deserialization");
    }

    private function isAssociative(array $array)
    {
        return array_values($array) !== $array;
    }

    private function prepareFormField($partName, $value, $boundary)
    {
        return implode(self::LINEFEED, [
            "Content-Disposition: form-data; name=\"{$partName}\"",
            "",
            filter_var($value),
        ]);
    }

    private function prepareFilePart($partName, $file, $boundary)
    {
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);
        $filePath = stream_get_meta_data($file)['uri'];
        $data = file_get_contents($filePath);
        $mimeType = $fileInfo->buffer($data);

        $splitFilePath = explode(DIRECTORY_SEPARATOR, $filePath);
        $filePath = end($splitFilePath);
        $disallow = ["\0", "\"", "\r", "\n"];
        $filePath = str_replace($disallow, "_", $filePath);
        return implode(self::LINEFEED, [
            "Content-Disposition: form-data; name=\"{$partName}\"; filename=\"{$filePath}\"",
            "Content-Type: {$mimeType}",
            "",
            $data,
        ]);
    }

    private function prepareFormPart($partName, $formPart, $boundary)
    {
        $contentDisposition = "Content-Disposition: form-data; name=\"{$partName}\"";

        $partHeaders = $formPart->getHeaders();
        if (array_key_exists("Content-Type", $partHeaders)) {
            if ($partHeaders["Content-Type"] === "application/json") {
                $contentDisposition .= "; filename=\"{$partName}.json\"";
            }
            $tempRequest = new HttpRequest('/', 'POST');
            $tempRequest->headers = $partHeaders;
            $tempRequest->body = $formPart->getValue();
            $encoder = new Encoder();
            $partValue = $encoder->serializeRequest($tempRequest);
        } else {
            $partValue = $formPart->getValue();
        }

        $finalPartHeaders = [];
        foreach ($partHeaders as $k => $v) {
            $finalPartHeaders[] = "{$k}: {$v}";
        }

        $body = array_merge([$contentDisposition], $finalPartHeaders, [""], [$partValue]);

        return implode(self::LINEFEED, $body);
    }
}
