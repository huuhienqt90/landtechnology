<?php

namespace Hamilton\PayPal\Api;

use Hamilton\PayPal\Common\PayPalModel;

/**
 * Class Transactions
 *
 * 
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\Amount amount
 */
class Transactions extends PayPalModel
{
    /**
     * Amount being collected.
     * 
     *
     * @param \Hamilton\PayPal\Api\Amount $amount
     * 
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Amount being collected.
     *
     * @return \Hamilton\PayPal\Api\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

}
