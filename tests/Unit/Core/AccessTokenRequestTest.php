<?php

namespace Test\Unit\Core;

use PayPalCheckoutSdk\Core\AccessTokenRequest;
use Test\UnitTestCase;

class AccessTokenRequestTest extends UnitTestCase
{

    /**
     * testBuildAccessTokenRequestWithoutRefreshToken
     */
    public function testBuildAccessTokenRequestWithoutRefreshToken()
    {
        $accessTokenRequest = new AccessTokenRequest($this->createEnvironmentMock());

        $this->assertSame('/v1/oauth2/token', $accessTokenRequest->path);
        $this->assertSame('POST', $accessTokenRequest->verb);

        $this->assertSame('client_credentials', $accessTokenRequest->body['grant_type']);
        $this->assertNotSame('refresh_token', $accessTokenRequest->body['grant_type']);

        $this->assertSame('application/x-www-form-urlencoded', $accessTokenRequest->headers['Content-Type']);
        $this->assertSame('Basic '.self::ENV_MOCK_AUTHORIZATION_STRING, $accessTokenRequest->headers['Authorization']);
    }

    /**
     * testBuildAccessTokenRequestWithoutRefreshToken
     */
    public function testBuildAccessTokenRequestWithRefreshToken()
    {
        $refreshToken = 'exampleRefreshToken';
        $accessTokenRequest = new AccessTokenRequest($this->createEnvironmentMock(), $refreshToken);

        $this->assertSame('/v1/oauth2/token', $accessTokenRequest->path);
        $this->assertSame('POST', $accessTokenRequest->verb);

        $this->assertSame('refresh_token', $accessTokenRequest->body['grant_type']);
        $this->assertSame($refreshToken, $accessTokenRequest->body['refresh_token']);
        $this->assertNotSame('client_credentials', $accessTokenRequest->body['grant_type']);

        $this->assertSame('application/x-www-form-urlencoded', $accessTokenRequest->headers['Content-Type']);
        $this->assertSame('Basic '.self::ENV_MOCK_AUTHORIZATION_STRING, $accessTokenRequest->headers['Authorization']);
    }
}
