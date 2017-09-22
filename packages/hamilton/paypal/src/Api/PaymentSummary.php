<?php

namespace Hamilton\PayPal\Api;

use Hamilton\PayPal\Common\PayPalModel;

/**
 * Class PaymentSummary
 *
 * Payment/Refund break up
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\Currency paypal
 * @property \PayPal\Api\Currency other
 */
class PaymentSummary extends PayPalModel
{
    /**
     * Total Amount paid/refunded via PayPal.
     *
     * @param \Hamilton\PayPal\Api\Currency $paypal
     * 
     * @return $this
     */
    public function setPaypal($paypal)
    {
        $this->paypal = $paypal;
        return $this;
    }

    /**
     * Total Amount paid/refunded via PayPal.
     *
     * @return \Hamilton\PayPal\Api\Currency
     */
    public function getPaypal()
    {
        return $this->paypal;
    }

    /**
     * Total Amount paid/refunded via other sources.
     *
     * @param \Hamilton\PayPal\Api\Currency $other
     * 
     * @return $this
     */
    public function setOther($other)
    {
        $this->other = $other;
        return $this;
    }

    /**
     * Total Amount paid/refunded via other sources.
     *
     * @return \Hamilton\PayPal\Api\Currency
     */
    public function getOther()
    {
        return $this->other;
    }

}
