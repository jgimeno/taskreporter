<?php

namespace JGimeno\TaskReporter\Tests\Domain\Value;

use JGimeno\TaskReporter\Domain\Value\PortNumber;

class PortNumberTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectPortNumber()
    {
        $httpPortNumber = new PortNumber(80);
        $this->assertInstanceOf(PortNumber::class, $httpPortNumber);
    }

    /**
     * @expectedException JGimeno\TaskReporter\Domain\Exception\ValueObjectException
     */
    public function testWhenThePortIsOutOfBounds()
    {
        new PortNumber(100000);
    }
}
