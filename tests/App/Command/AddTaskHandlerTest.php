<?php

namespace JGimeno\TaskReporter\Tests\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\App\Command\AddTask;
use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class AddTaskHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JGimeno\TaskReporter\App\Command\AddTaskHandler
     */
    public $commandHandler;

    /**
     * @var JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;
     */
    public $workingDayRepo;

    public function testInstanceOf()
    {
        $handler = new AddTaskHandler(new InMemoryWorkingDayRepository());
        $this->assertInstanceOf('JGimeno\TaskReporter\App\Command\AddTaskHandler', $handler);
    }

    public function testICanAddATaskFromCommand()
    {
        $command = new AddTask("Task test");
        $this->commandHandler->handle($command);

        $workingDayFromRepo = $this->workingDayRepo->getByDate(Carbon::now());

        $expectedWorkingDay = new WorkingDay(WorkingDayId::generate());
        $expectedWorkingDay->addTask(new Task("Task test"));

        $this->assertEquals($expectedWorkingDay->getDate(), $workingDayFromRepo->getDate());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->workingDayRepo = new InMemoryWorkingDayRepository();
        $this->commandHandler = new AddTaskHandler($this->workingDayRepo);
    }
}
