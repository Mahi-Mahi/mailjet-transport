<?php

namespace MahiMahi\MailjetTransport;

use Illuminate\Mail\MailServiceProvider as MailProvider;
use MahiMahi\MailjetTransport\MailjetTransportManager;

class MailjetTransportMailProvider extends MailProvider
{
    protected function registerSwiftTransport()
    {
        $this->app->singleton('swift.transport', function ($app) {
            return new MailjetTransportManager($app);
        });
    }

}
