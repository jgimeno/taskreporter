<?php

namespace JGimeno\TaskReporter\Domain\Exception;

class EmptyWorkingDayException extends DomainException
{
    public function __construct()
    {
        $this->message = "You have not defined any task for today.";
    }
}
