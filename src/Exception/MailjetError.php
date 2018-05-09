<?php

namespace MahiMahi\MailjetTransport\Exception;

use Exception;
use Log;

class MailjetError extends Exception
{
    /**
     * @return static
     */
    public static function defaultError($error)
    {
        if ( isset($error['ErrorMessage']) )
            $message = $error['ErrorMessage'];

        if ( isset($error['Messages']) )
            $message = $error['Messages'][0]['Errors'][0]['ErrorMessage'];

        return new static($message);
    }

}
