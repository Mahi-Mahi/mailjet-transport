<?php

namespace MahiMahi\MailjetTransport;

use Illuminate\Mail\TransportManager;
use Mailjet\Client;

class MailjetTransportManager extends TransportManager
{
    protected function createMailjetDriver()
    {

        $config = $this->app['config']->get('mailjet', []);

        return new MailjetTransport(
            new Client($config['public_key'], $config['private_key'],
                true, ['version' => 'v3.1'])
        );
    }

}
