<?php

namespace JGimeno\TaskReporter\Infrastructure\Exception;

class MailProviderException extends InfrastructureException
{
    public function __construct($message)
    {
        $this->message = "Error with mail provider: " . $message;
    }
}
