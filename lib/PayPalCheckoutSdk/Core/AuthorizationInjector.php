<?php

namespace PayPalCheckoutSdk\Core;

use PayPalCheckoutSdk\Requests\Token\AccessTokenRequest;
use PayPalCheckoutSdk\Requests\Token\RefreshTokenRequest;
use PayPalHttp\HttpRequest;
use PayPalHttp\Injector;
use PayPalHttp\HttpClient;

class AuthorizationInjector implements Injector
{
    const BEARER_PREFIX = 'Bearer ';
    const BASIC_PREFIX = 'Basic ';

    private $client;
    private $environment;

    public function __construct(HttpClient $client, PayPalEnvironment $environment)
    {
        $this->client = $client;
        $this->environment = $environment;
    }

    public function inject($request)
    {
        if (!$this->hasAuthHeader($request) && !$this->isAuthRequest($request))
        {
            $accessToken = $this->environment->getAccessToken();
            if (is_null($accessToken) || $accessToken->isExpired()) {
                $this->fetchAccessToken();
            }

            $request->headers['Authorization'] = $this->environment->bearerAuthorizationString();
        }
    }

    private function fetchAccessToken()
    {
        $accessTokenResponse = $this->client->execute(new AccessTokenRequest($this->environment));
        $accessToken = $accessTokenResponse->result;

        $this->environment->saveTokens(
            $accessToken->access_token,
            $accessToken->token_type,
            $accessToken->expires_in
        );
    }

    private function isAuthRequest($request): bool
    {
        return $request instanceof AccessTokenRequest || $request instanceof RefreshTokenRequest;
    }

    private function hasAuthHeader(HttpRequest $request): bool
    {
        return array_key_exists("Authorization", $request->headers);
    }
}
