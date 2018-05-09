<?php

namespace MahiMahi\MailjetTransport;

use Illuminate\Mail\Transport\Transport;
use Mailjet\Resources;
use Swift_Mime_SimpleMessage;

use MahiMahi\MailjetTransport\Exception\MailjetError;

use Log;

class MailjetTransport extends Transport
{
    /**
     * Mailjet client instance.
     *
     * @var \Mailjet\Client
     */
    protected $mailjet;

    /**
     * Create a new Mailjet transport instance.
     *
     * @param  \Mailjet\Client  $client
     * @return void
     */
    public function __construct(\Mailjet\Client $mailjet)
    {
        $this->mailjet = $mailjet;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $payload = [
            'Messages' => [
                [
                    'From' => array_filter([
                        'Email' => key($message->getFrom()),
                        'Name' => current($message->getFrom())
                    ]),
                    'To' => [],
                    'Subject' => $message->getSubject(),
                    'TextPart' => $message->getBody(),
                    'HTMLPart' => $message->getBody()
                ],
            ],
        ];

        foreach ((array) $message->getTo() as $email => $name) {
          $payload['Messages'][0]['To'][] = array_filter(['Email' => $email, 'Name' => $name]);
        }

        $response = $this->mailjet->post(Resources::$Email, ['body' => $payload]);

        if( $response->getStatus() != 200 ):
            throw MailjetError::defaultError($response->getBody());
        endif;

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

}
