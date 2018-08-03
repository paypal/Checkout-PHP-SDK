<?php

namespace BraintreeHttp;

/**
 * Interface Environment
 * @package BraintreeHttp
 *
 * Describes a domain that hosts a REST API, against which an HttpClient will make requests.
 * @see HttpClient
 */
interface Environment
{
    /**
     * @return string
     */
    public function baseUrl();
}
