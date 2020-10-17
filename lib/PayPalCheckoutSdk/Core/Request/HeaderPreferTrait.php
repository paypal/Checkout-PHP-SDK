<?php

namespace PayPalCheckoutSdk\Core\Request;

trait HeaderPreferTrait
{
    /**
     * @param string $prefer
     */
    public function prefer($prefer)
    {
        $this->headers["Prefer"] = $prefer;
    }
}
