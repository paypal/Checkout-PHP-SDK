<?php

namespace PayPalCheckoutSdk\Setup\TokenPersistence;

class TokenPersistorPayload
{
    public $token;
    public $tokenType;
    public $expiresIn;
    public $createDate;
    public $refreshToken;

    public function __construct($token, $tokenType, $expiresIn, $createDate, $refreshToken = null)
    {
        $this->token = $token;
        $this->tokenType = $tokenType;
        $this->createDate = $createDate;
        $this->expiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
    }
}