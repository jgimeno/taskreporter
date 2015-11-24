<?php

namespace JGimeno\TaskReporter\Tests\Domain\Entity;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\Task;

class WorkingDayTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $workingDay = new WorkingDay();
        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Entity\WorkingDay', $workingDay);
    }

    public function testTheIdOfAWorkingDayIsRelatedToItsDateOfCreation()
    {
        $workingDay = new WorkingDay();

        $this->assertEquals(Carbon::now('Europe/Madrid')->toDateString(), $workingDay->getDate());
    }

    public function testWorkingDayAcceptsTasks()
    {
        $task = new Task("Task day.");

        $workindDay = new WorkingDay();
        $workindDay->addTask($task);
    }

    public function testWorkingDayCanReturnAllTasks()
    {
        $task = new Task("Task day.");

        $workindDay = new WorkingDay();
        $workindDay->addTask($task);

        $tasks = $workindDay->getTasks();

        $this->assertCount(1, $tasks);
    }
}
