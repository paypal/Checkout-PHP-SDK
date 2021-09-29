<?php

namespace PayPalCheckoutSdk\Core;

use PayPalCheckoutSdk\Setup\TokenPersistence\ISetupPayPalEnvironment;
use PayPalCheckoutSdk\Setup\TokenPersistence\ITokenPersistor;
use PayPalCheckoutSdk\Setup\TokenPersistence\TokenPersistorPayload;
use PayPalHttp\Environment;

abstract class PayPalEnvironment implements Environment, ISetupPayPalEnvironment
{
    private $clientId;
    private $clientSecret;
    private $refreshToken;
    protected $tokenPersistor;
    private $accessToken;

    public function __construct($clientId, $clientSecret, $accessToken = null, $refreshToken = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }

    // TODO, location of these functions...
    public function basicAuthorizationString()
    {
        return AuthorizationInjector::BASIC_PREFIX . base64_encode($this->clientId . ":" . $this->clientSecret);
    }

    public function bearerAuthorizationString()
    {
        return AuthorizationInjector::BEARER_PREFIX . $this->accessToken->token;
    }

    public function setTokenPersistor(ITokenPersistor $persistor) {
        $this->tokenPersistor = $persistor;
    }

    public function getRefreshToken() {
        $this->loadTokens();

        return $this->refreshToken;
    }

    public function getAccessToken() {
        $this->loadTokens();

        return $this->accessToken;
    }

    private function loadTokens() {
        if(!$this->accessToken && isset($this->tokenPersistor)) {
            $payload = $this->tokenPersistor->loadTokens();

            $this->refreshToken = $payload->refreshToken;

            $this->accessToken = new AccessToken(
                $payload->token,
                $payload->tokenType,
                $payload->expiresIn,
                $payload->createDate
            );
        }
    }

    public function saveTokens($accessToken, $tokenType, $expiresIn, $refreshToken = null) {
        if(isset($this->tokenPersistor)) {
            $this->tokenPersistor->saveTokens(
                new TokenPersistorPayload(
                    $accessToken,
                    $tokenType,
                    $expiresIn,
                    $this->accessToken->createDate ?? time(),
                    $refreshToken ?? $this->refreshToken
                )
            );
        }

        $this->accessToken = new AccessToken(
            $accessToken,
            $tokenType,
            $expiresIn,
            $this->accessToken->createDate ?? time()
        );
    }
}