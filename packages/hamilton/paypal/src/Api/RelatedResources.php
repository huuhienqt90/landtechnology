<?php

namespace Hamilton\PayPal\Api;

use Hamilton\PayPal\Common\PayPalModel;

/**
 * Class RelatedResources
 *
 * Each one representing a financial transaction (Sale, Authorization, Capture, Refund) related to the payment.
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\Sale sale
 * @property \PayPal\Api\Authorization authorization
 * @property \PayPal\Api\Order order
 * @property \PayPal\Api\Capture capture
 * @property \PayPal\Api\Refund refund
 */
class RelatedResources extends PayPalModel
{
    /**
     * Sale transaction
     *
     * @param \Hamilton\PayPal\Api\Sale $sale
     * 
     * @return $this
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
        return $this;
    }

    /**
     * Sale transaction
     *
     * @return \Hamilton\PayPal\Api\Sale
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Authorization transaction
     *
     * @param \Hamilton\PayPal\Api\Authorization $authorization
     * 
     * @return $this
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
        return $this;
    }

    /**
     * Authorization transaction
     *
     * @return \Hamilton\PayPal\Api\Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * Order transaction
     *
     * @param \Hamilton\PayPal\Api\Order $order
     * 
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Order transaction
     *
     * @return \Hamilton\PayPal\Api\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Capture transaction
     *
     * @param \Hamilton\PayPal\Api\Capture $capture
     * 
     * @return $this
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
        return $this;
    }

    /**
     * Capture transaction
     *
     * @return \Hamilton\PayPal\Api\Capture
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * Refund transaction
     *
     * @param \Hamilton\PayPal\Api\Refund $refund
     * 
     * @return $this
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
        return $this;
    }

    /**
     * Refund transaction
     *
     * @return \Hamilton\PayPal\Api\Refund
     */
    public function getRefund()
    {
        return $this->refund;
    }

}
