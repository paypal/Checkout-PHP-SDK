<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpRequest;

abstract class AbstractHttpRequest extends HttpRequest
{
    /**
     * @param string $path
     * @param string $verb
     */
    public function __construct($path, $verb)
    {
        parent::__construct($this->createPathWithPossiblePrefix($path), $verb);

        $this->addHeaderContentTypeJson();
    }

    /**
     * @return string|null
     */
    protected function possiblePrefix()
    {
        return null;
    }

    /**
     * @param string $path
     * @param array  $parameter
     *
     * @return string
     */
    protected function buildPathWithPlaceholders($path, $parameter)
    {
        foreach ($parameter as $search => $subject) {
            $path = str_replace('{'.$search.'}', urlencode($subject), $path);
        }

        return $path;
    }

    /**
     * @return void
     */
    protected function addHeaderContentTypeJson()
    {
        $this->headers["Content-Type"] = "application/json";
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function createPathWithPossiblePrefix($path)
    {
        if (!is_null($this->possiblePrefix())) {
            return $this->possiblePrefix().$path;
        }

        return $path;
    }
}
