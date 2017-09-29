<?php

namespace Hamilton\PayPal\Api;

use Hamilton\PayPal\Common\PayPalModel;

/**
 * Class PayoutBatch
 *
 * The PayPal-generated batch status.
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\PayoutBatchHeader batch_header
 * @property \PayPal\Api\PayoutItemDetails[] items
 * @property \PayPal\Api\Links[] links
 */
class PayoutBatch extends PayPalModel
{
    /**
     * A batch header. Includes the generated batch status.
     *
     * @param \Hamilton\PayPal\Api\PayoutBatchHeader $batch_header
     * 
     * @return $this
     */
    public function setBatchHeader($batch_header)
    {
        $this->batch_header = $batch_header;
        return $this;
    }

    /**
     * A batch header. Includes the generated batch status.
     *
     * @return \Hamilton\PayPal\Api\PayoutBatchHeader
     */
    public function getBatchHeader()
    {
        return $this->batch_header;
    }

    /**
     * An array of items in a batch payout.
     *
     * @param \Hamilton\PayPal\Api\PayoutItemDetails[] $items
     * 
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * An array of items in a batch payout.
     *
     * @return \Hamilton\PayPal\Api\PayoutItemDetails[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Append Items to the list.
     *
     * @param \Hamilton\PayPal\Api\PayoutItemDetails $payoutItemDetails
     * @return $this
     */
    public function addItem($payoutItemDetails)
    {
        if (!$this->getItems()) {
            return $this->setItems(array($payoutItemDetails));
        } else {
            return $this->setItems(
                array_merge($this->getItems(), array($payoutItemDetails))
            );
        }
    }

    /**
     * Remove Items from the list.
     *
     * @param \Hamilton\PayPal\Api\PayoutItemDetails $payoutItemDetails
     * @return $this
     */
    public function removeItem($payoutItemDetails)
    {
        return $this->setItems(
            array_diff($this->getItems(), array($payoutItemDetails))
        );
    }


    /**
     * Sets Links
     *
     * @param \Hamilton\PayPal\Api\Links[] $links
     *
     * @return $this
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * Gets Links
     *
     * @return \Hamilton\PayPal\Api\Links[]
     */
    public function getLinks()
    {
        return $this->links;
    }

}