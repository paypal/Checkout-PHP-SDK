<?php

namespace Test\Unit\Core;

use PayPalCheckoutSdk\Core\AccessToken;
use Test\UnitTestCase;

class AccessTokenTest extends UnitTestCase
{
    /**
     * testCreateAccessToken
     */
    public function testCreateAccessToken()
    {
        $token = 'exampleToken';
        $tokenType = 'exampleTokenType';
        $expiresIn = 4711;

        $accessToken = new AccessToken(
            $token,
            $tokenType,
            $expiresIn
        );

        $this->assertInstanceOf(AccessToken::class, $accessToken);
        $this->assertSame($token, $accessToken->getToken());
        $this->assertSame($tokenType, $accessToken->getTokenType());
        $this->assertSame($expiresIn, $accessToken->getExpiresIn());
        $this->assertFalse($accessToken->isExpired());
    }
}
