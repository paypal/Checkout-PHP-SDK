<?php

namespace PayPalCheckoutSdk\Core;

class AccessToken
{
    public $token;
    public $tokenType;
    public $expiresIn;
    public $createDate;

    public function __construct($token, $tokenType, $expiresIn, $createDate = null)
    {
        $this->token = $token;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->createDate = $createDate ?? time();
    }

    public function isExpired()
    {
        return time() >= $this->createDate + $this->expiresIn;
    }
}