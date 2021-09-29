<?php

namespace PayPalCheckoutSdk\Setup\TokenPersistence;

/**
 * Use this interface to persist the tokens into storage
 */
interface ITokenPersistor
{
    public function loadTokens(): TokenPersistorPayload;
    public function saveTokens(TokenPersistorPayload $payload);
}