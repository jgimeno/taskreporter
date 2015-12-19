<?php

namespace JGimeno\TaskReporter\Tests\App\Command;

use JGimeno\TaskReporter\App\Command\ListTasks;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class ListTasksHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function createWorkingDayWithTwoTasks()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());

        $task1 = new Task("Going to the toilet");
        $task2 = new Task("Return from the toilet");

        $workingDay->addTask($task1);
        $workingDay->addTask($task2);

        return $workingDay;
    }

    public function testListTasksReturnsArrayOfTwoTasksCreated()
    {
        $workingDayWithTwoTasks = $this->createWorkingDayWithTwoTasks();

        $repo = new InMemoryWorkingDayRepository();

        $repo->add($workingDayWithTwoTasks);

        $listTasksHandler = new ListTasksHandler($repo);

        $tasks = $listTasksHandler->handle(new ListTasks());

        $this->assertCount(2, $tasks);
    }
}
