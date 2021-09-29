<?php

namespace PayPalCheckoutSdk\Setup\TokenPersistence;

interface ISetupPayPalEnvironment
{
    /**
     * @param ITokenPersistor $persistor use this to store tokens based on your own internal logic
     * @return void
     */
    public function setTokenPersistor(ITokenPersistor $persistor);
}