<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpClient;
use PayPalHttp\HttpRequest;
use PayPalHttp\Injector;

class AuthorizationInjector implements Injector
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var PayPalEnvironment
     */
    private $environment;

    /**
     * @var string|null
     */
    private $refreshToken;

    /**
     * @var
     */
    public $accessToken;

    /**
     * @param HttpClient        $client
     * @param PayPalEnvironment $environment
     * @param string|null       $refreshToken
     */
    public function __construct(HttpClient $client, PayPalEnvironment $environment, $refreshToken)
    {
        $this->client       = $client;
        $this->environment  = $environment;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param HttpRequest $request
     */
    public function inject($request)
    {
        if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request)) {
            if (is_null($this->accessToken) || $this->accessToken->isExpired()) {
                $this->accessToken = $this->fetchAccessToken();
            }
            $request->headers['Authorization'] = 'Bearer '.$this->accessToken->token;
        }
    }

    /**
     * @return AccessToken
     */
    private function fetchAccessToken()
    {
        $accessTokenResponse = $this->client->execute(new AccessTokenRequest($this->environment, $this->refreshToken));
        $accessToken         = $accessTokenResponse->result;

        return new AccessToken($accessToken->access_token, $accessToken->token_type, $accessToken->expires_in);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function isAuthRequest($request)
    {
        return $request instanceof AccessTokenRequest || $request instanceof RefreshTokenRequest;
    }

    /**
     * @param HttpRequest $request
     *
     * @return bool
     */
    private function hasAuthHeader(HttpRequest $request)
    {
        return array_key_exists('Authorization', $request->headers);
    }
}
