<?php

namespace JGimeno\TaskReporter\Domain\Exception;

class TaskEmptyException extends DomainException
{
    public function __construct()
    {
        $this->message = "A task cannot be empty";
    }
}
