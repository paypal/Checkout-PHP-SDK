<?php

namespace PayPalCheckoutSdk\Core;

class AccessToken
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $tokenType;

    /**
     * @var int
     */
    public $expiresIn;

    /**
     * @var int
     */
    private $createDate;

    /**
     * @param string $token
     * @param string $tokenType
     * @param int $expiresIn
     */
    public function __construct($token, $tokenType, $expiresIn)
    {
        $this->token = $token;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->createDate = time();
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return time() >= $this->createDate + $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
}
