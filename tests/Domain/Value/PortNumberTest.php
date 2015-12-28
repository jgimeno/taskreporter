<?php

namespace JGimeno\TaskReporter\Tests\Domain\Value;

use JGimeno\TaskReporter\Domain\Value\PortNumber;

class PortNumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException JGimeno\TaskReporter\Domain\Exception\ValueObjectException
     */
    public function testWhenThePortIsOutOfBounds()
    {
        new PortNumber(100000);
    }
}
