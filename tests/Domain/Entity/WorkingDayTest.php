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
        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Entity\WorkingDay', $this->workingDay);
    }

    public function testTheIdOfAWorkingDayIsRelatedToItsDateOfCreation()
    {
        $this->assertEquals(Carbon::now('Europe/Madrid')->toDateString(), $this->workingDay->getDate());
    }

    public function testWorkingDayAcceptsTasks()
    {
        $task = new Task("Task day.");
        $this->workingDay->addTask($task);
    }

    public function testWorkingDayCanReturnAllTasks()
    {
        $task = new Task("Task day.");
        $this->workingDay->addTask($task);
        $tasks = $this->workingDay->getTasks();
        $this->assertCount(1, $tasks);
    }

    public function testWorkingDayCanDeleteATaskWithDescription()
    {
        $task = new Task("Task day.");
        $task2 = new Task("Task 2 day.");

        $this->workingDay->addTask($task);
        $this->workingDay->addTask($task2);

        $this->workingDay->deleteTaskWithDescription('Task 2 day.');
        $this->assertCount(1, $this->workingDay->getTasks());
    }

    public function getTaskByDescriptionReturnCorrectTask()
    {
        $task = new Task("Task day.");
        $this->workingDay->addTask($task);
        $retrievedTask = $this->workingDay->getTaskByDescription("Task day.");
        $this->assertSame($task, $retrievedTask);
    }

    public function getTaskByDescriptionThrowsExceptionWhenFoundTaskIsNotUnique()
    {
        $task = new Task("Task day.");
        $task2 = new Task("Task day.");

        $this->workingDay->addTask($task);
        $this->workingDay->addTask($task2);

        $this->setExpectedException('JGimeno\TaskReporter\Domain\Exception\DomainException');

        $this->workingDay->getTaskByDescription("Task day.");
    }

    public function getTaskByDescriptionThrowsExceptionWhenTaskNotFound()
    {
        $task = new Task("Task day.");

        $this->workingDay->addTask($task);

        $this->setExpectedException('JGimeno\TaskReporter\Domain\Exception\DomainException');

        $this->workingDay->getTaskByDescription("No task.");
    }

    protected function setUp()
    {
        parent::setUp();
        $this->workingDay = new WorkingDay(WorkingDayId::generate());
    }
}
