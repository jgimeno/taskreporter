<?php

namespace JGimeno\TaskReporter\Tests\Domain\Entity;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;

class WorkingDayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var WorkingDay
     */
    protected $workingDay;

    public function testInstanceOf()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Entity\WorkingDay', $workingDay);
    }

    public function testTheIdOfAWorkingDayIsRelatedToItsDateOfCreation()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());

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

    protected function setUp()
    {
        parent::setUp();

    }
}
