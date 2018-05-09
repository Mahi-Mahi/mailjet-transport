<?php

namespace MahiMahi\MailjetTransport;

use Illuminate\Support\ServiceProvider;

class MailjetTransportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/../config/mailjet.php' => config_path('mailjet.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/views', 'mailjet-transport');

    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('swift.transport', function ($app) {
            return new MailjetTransportManager($app);
        });
    }

}
