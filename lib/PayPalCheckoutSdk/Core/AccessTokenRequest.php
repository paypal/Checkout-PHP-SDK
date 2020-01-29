<?php

namespace PayPalCheckoutSdk\Core;

use PayPalHttp\HttpRequest;

class AccessTokenRequest extends HttpRequest
{
    /**
     * @param PayPalEnvironment $environment
     * @param string|null       $refreshToken
     */
    public function __construct(PayPalEnvironment $environment, $refreshToken = null)
    {
        parent::__construct('/v1/oauth2/token', 'POST');

        $body['grant_type'] = 'client_credentials';
        if (!is_null($refreshToken)) {
            $body['grant_type']    = 'refresh_token';
            $body['refresh_token'] = $refreshToken;
        }

        $this->body                     = $body;
        $this->headers['Content-Type']  = 'application/x-www-form-urlencoded';
        $this->headers['Authorization'] = 'Basic '.$environment->authorizationString();
    }
}
