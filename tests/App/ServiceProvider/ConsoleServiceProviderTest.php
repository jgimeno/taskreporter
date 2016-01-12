<?php

namespace JGimeno\TaskReporter\Tests\ServiceProvider;

use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use JGimeno\TaskReporter\App\Command\DeleteTaskHandler;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\App\Console\CreateTask;
use JGimeno\TaskReporter\App\Console\DeleteTask;
use JGimeno\TaskReporter\App\Console\ListTasks;
use JGimeno\TaskReporter\Infrastructure\Persistence\DoctrineWorkingDayRepository;
use League\Container\Container;

class ConsoleServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        global $container;
        $this->container = $container;
    }

    public function testListTasksConsoleIsCreatedWithTheCorrectCommandHandler()
    {
        $listTasksConsole = new ListTasks(
            new ListTasksHandler(new DoctrineWorkingDayRepository($this->container->get('entityManager')))
        );

        $this->assertEquals(
            $listTasksConsole,
            $this->container->get('JGimeno\TaskReporter\App\Console\ListTasks')
        );

    }

    public function testAddTaskConsoleIsCreatedWithTheCorrectCommandHandler()
    {
        $addTasksConsole = new CreateTask(
            new AddTaskHandler(new DoctrineWorkingDayRepository($this->container->get('entityManager')))
        );

        $this->assertEquals(
            $addTasksConsole,
            $this->container->get('JGimeno\TaskReporter\App\Console\CreateTask')
        );

    }

    public function testDeleteTaskConsoleIsCreatedWithTheCorrectCommandHandler()
    {
        $addTasksConsole = new DeleteTask(
            new DeleteTaskHandler(new DoctrineWorkingDayRepository($this->container->get('entityManager')))
        );

        $this->assertEquals(
            $addTasksConsole,
            $this->container->get('JGimeno\TaskReporter\App\Console\DeleteTask')
        );

    }
}