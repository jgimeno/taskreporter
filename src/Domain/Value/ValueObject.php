<?php

namespace JGimeno\TaskReporter\Domain\Value;

class ValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value->toString();
    }
}