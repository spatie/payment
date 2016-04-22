<?php

namespace Spatie\Payment;

use Illuminate\Support\ServiceProvider;
use Spatie\Payment\Gateways\Europabank\PaymentGateway as EuropabankPaymentGateway;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
		$this->mergeConfigFrom(__DIR__.'/../config/payment.php', 'payment');

		$this->publishes([
			__DIR__.'/../resources/lang' => base_path('resources/lang/vendor/paginateroute'),
		], 'lang');

		$this->publishes([
			__DIR__.'/../config/payment.php' => base_path('config/payment.php'),
		], 'config');
    }

    public function register()
    {
        $this->app->bind(PaymentGateway::class, EuropabankPaymentGateway::class);
    }
}
