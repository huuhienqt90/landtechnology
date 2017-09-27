<?php

namespace Hamilton\PayPal;
use Illuminate\Support\ServiceProvider;

class PayPalProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/paypal.php' => config_path('paypal.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/paypal.php', 'paypal'
        );
    }
}
