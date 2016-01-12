<?php

namespace JGimeno\TaskReporter\Tests\App\Command;

use JGimeno\TaskReporter\App\Command\DeleteTask;
use JGimeno\TaskReporter\App\Command\DeleteTaskHandler;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class DeleteTaskHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DeleteTaskHandler
     */
    public $commandHandler;

    /**
     * @var WorkingDayRepositoryInterface
     */
    public $workingDayRepo;

    public function testInstanceOf()
    {
        $handler = new DeleteTaskHandler(new InMemoryWorkingDayRepository());
        $this->assertInstanceOf('JGimeno\TaskReporter\App\Command\DeleteTaskHandler', $handler);
    }

    public function testICanGetTheWorkingDayFromCommand()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $workingDay->addTask(new Task("Task test"));
        $this->workingDayRepo->add($workingDay);

        $this->assertSame($workingDay, $this->commandHandler->handleShowList());
    }

    public function testICanGetTheWorkingDayFromCommandThrowsExceptionWhenNoTasks()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $this->workingDayRepo->add($workingDay);

        $this->setExpectedException('JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException');

        $this->commandHandler->handleShowList();
    }

    public function testICanDeleteTaskFromTheWorkingDayFromCommand()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $workingDay->addTask(new Task("Task test"));
        $this->workingDayRepo->add($workingDay);

        $this->commandHandler->handleShowList();

        $this->commandHandler->handleDelete(new DeleteTask("Task test"));

        $this->assertCount(0, $workingDay->getTasks());
    }

    public function testDeleteTaskFromCommandThrowsExceptionWhenTaskDoesNotExist()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $workingDay->addTask(new Task("Task test"));
        $this->workingDayRepo->add($workingDay);

        $this->commandHandler->handleShowList();

        $this->setExpectedException('JGimeno\TaskReporter\Domain\Exception\DomainException');

        $this->commandHandler->handleDelete(new DeleteTask("Task testa"));
    }

    protected function setUp()
    {
        parent::setUp();
        $this->workingDayRepo = new InMemoryWorkingDayRepository();
        $this->commandHandler = new DeleteTaskHandler($this->workingDayRepo);
    }
}
