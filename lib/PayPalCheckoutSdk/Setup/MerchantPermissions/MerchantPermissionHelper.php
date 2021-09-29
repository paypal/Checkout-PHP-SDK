<?php

namespace PayPalCheckoutSdk\Setup\MerchantPermissions;

use PayPalCheckoutSdk\Requests\Token\RefreshTokenRequest;
use PayPalCheckoutSdk\Setup\PayPalHttpClient;
use PayPalHttp\HttpRequest;

class MerchantPermissionHelper extends HttpRequest
{
    /**
     * The authorization code is valid for only three minutes.
     * The authorization code is returned as a parameter with the key 'code' in the call back to your server.
     *
     * You must use this code to generate the refresh token for the merchant’s app.
     * This only needs to be done once, unless the merchant revokes permission.
     *
     * See authorizeCode(...) below
     *
     * @param $environment, 'production' for production, otherwise sandbox
     * @param $scopes, https://developer.paypal.com/docs/log-in-with-paypal/reference/#scope-attributes
     * @param $redirectUri, must match the return url you have set in your PayPal settings
     * @param $clientId, your rest api client id
     * @return string
     */
    public function buildUrl($environment, $scopes, $redirectUri, $clientId) {

        $baseUrl = $environment === 'production' ?
                'https://www.paypal.com/signin/authorize?' :
                'https://www.sandbox.paypal.com/signin/authorize?';

        return http_build_query(
            [
                'scopes' => [],
                'response_type' => implode(' ', $scopes),
                'redirect_uri' => $redirectUri,
                'client_id' => $clientId
            ]
        );
    }

    public function authorizeCode(PayPalHttpClient $client, $authorizationCode) {
        $response = $client->execute(new RefreshTokenRequest($client->paypalEnvironment, $authorizationCode));

        $tokens = $response->result;
        $client->paypalEnvironment->saveTokens(
            $tokens->access_token,
            $tokens->token_type,
            $tokens->expires_in,
            $tokens->refresh_token
        );
    }
}