<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class InMemoryWorkingDayRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function testATaskCanBeInsertedAndRetrievedByDate()
    {
        $task = new Task("Task test.");

        $workingDay = new WorkingDay();
        $workingDay->addTask($task);

        $repo = new InMemoryWorkingDayRepository();
        $repo->add($workingDay);

        $workingDayFromRepo = $repo->getByDate(Carbon::now());

        $this->assertEquals($workingDay, $workingDayFromRepo);
    }

    public function testRepoReturnsNullIfNotWorkingDayWithThatDayExists()
    {
        $repo = new InMemoryWorkingDayRepository();
        $workingDay = $repo->getByDate(Carbon::now());

        $this->assertNull($workingDay);
    }


}
