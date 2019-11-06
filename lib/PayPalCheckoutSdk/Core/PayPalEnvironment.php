<?php

namespace PayPalCheckoutSdk\Core;

use BraintreeHttp\Environment;

abstract class PayPalEnvironment implements Environment
{
    private $clientId;
    private $clientSecret;
	private $targetSubject;

    public function __construct($clientId, $clientSecret, $targetSubject = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->targetSubject = $targetSubject;
    }

    public function authorizationString()
    {
        return base64_encode($this->clientId . ":" . $this->clientSecret);
    }

	public function setTargetSubject($targetSubject)
	{
		$this->targetSubject = (string)$targetSubject;
		return $this;
	}

	public function getTargetSubject()
	{
		return $this->targetSubject;
	}
}

