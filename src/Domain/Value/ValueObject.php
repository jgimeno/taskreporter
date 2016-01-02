<?php

namespace JGimeno\TaskReporter\Domain\Value;

class ValueObject
{
    protected $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public function isEmpty()
    {
        return (is_null($this->value) || $this->value === '');
    }

    public function __toString()
    {
        return (string)$this->value;
    }


}
