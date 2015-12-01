<?php

namespace JGimeno\TaskReporter\Tests\Domain\Value;

use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use Ramsey\Uuid\Uuid;

class WorkingDayIdTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $workingDayId = WorkingDayId::generate();
        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Value\WorkingDayId', $workingDayId);
    }

    public function testToString()
    {
        $uuid = Uuid::uuid4();

        $workingDayID = new WorkingDayId($uuid);

        $this->assertEquals($uuid->toString(), $workingDayID);
    }
}
