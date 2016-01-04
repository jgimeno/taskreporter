<?php

namespace JGimeno\TaskReporter\Tests\ServiceProvider;

use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\Infrastructure\Persistence\DoctrineWorkingDayRepository;
use League\Container\Container;

class CommandServiceProviderTest extends \PHPUnit_Framework_TestCase
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

    public function testListTasksHandlerIsCreatedWithTheCorrectRepository()
    {

        $listTasksHandler = new ListTasksHandler(
            new DoctrineWorkingDayRepository($this->container->get('entityManager'))
        );

        $this->assertEquals(
            $listTasksHandler,
            $this->container->get('JGimeno\TaskReporter\App\Command\ListTasksHandler')
        );

    }

    public function testAddTaskHandlerIsCreatedWithTheCorrectRepository()
    {

        $listTasksHandler = new AddTaskHandler(
            new DoctrineWorkingDayRepository($this->container->get('entityManager'))
        );

        $this->assertEquals(
            $listTasksHandler,
            $this->container->get('JGimeno\TaskReporter\App\Command\AddTaskHandler')
        );

    }
}