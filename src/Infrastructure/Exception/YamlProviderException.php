<?php

namespace JGimeno\TaskReporter\Infrastructure\Exception;

class YamlProviderException extends InfrastructureException
{
    public function __construct($message)
    {
        $this->message = "Error with yaml provider: " . $message;
    }

}