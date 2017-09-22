<?php

namespace Hamilton\PayPal\Handler;

/**
 * Interface IPayPalHandler
 *
 * @package PayPal\Handler
 */
interface IPayPalHandler
{
    /**
     *
     * @param \Hamilton\PayPal\Core\PayPalHttpConfig $httpConfig
     * @param string $request
     * @param mixed $options
     * @return mixed
     */
    public function handle($httpConfig, $request, $options);
}
