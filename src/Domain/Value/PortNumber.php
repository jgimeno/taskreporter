<?php

namespace JGimeno\TaskReporter\Domain\Value;

use JGimeno\TaskReporter\Domain\Exception\ValueObjectException;
use ValueObjects\ValueObject;

class PortNumber extends ValueObject
{
    protected $value;

    public function __construct($portNumber)
    {
        $sanitizedPortNumber = $this->sanitize($portNumber);
        parent::__construct($sanitizedPortNumber);
    }

    /**
     * @param int $portNumber
     * @return mixed
     * @throws ValueObjectException
     */
    protected function sanitize($portNumber)
    {
        $options = array(
            'options' => array(
                'min_range' => 0,
                'max_range' => 65535
            )
        );

        $value = filter_var($portNumber, FILTER_VALIDATE_INT, $options);

        if (false === $value) {
            throw new ValueObjectException($value, array('int (>=0, <=65535)'));
        }

        return $value;
    }
}
