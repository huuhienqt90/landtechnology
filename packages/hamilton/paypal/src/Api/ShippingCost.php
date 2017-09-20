<?php

namespace Hamilton\PayPal\Api;

use Hamilton\PayPal\Common\PayPalModel;

/**
 * Class ShippingCost
 *
 * Shipping cost, as a percent or an amount.
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\Currency amount
 * @property \PayPal\Api\Tax tax
 */
class ShippingCost extends PayPalModel
{
    /**
     * The shipping cost, as an amount. Valid range is from 0 to 999999.99.
     *
     * @param \Hamilton\PayPal\Api\Currency $amount
     * 
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * The shipping cost, as an amount. Valid range is from 0 to 999999.99.
     *
     * @return \Hamilton\PayPal\Api\Currency
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * The tax percentage on the shipping amount.
     *
     * @param \Hamilton\PayPal\Api\Tax $tax
     * 
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * The tax percentage on the shipping amount.
     *
     * @return \Hamilton\PayPal\Api\Tax
     */
    public function getTax()
    {
        return $this->tax;
    }

}
