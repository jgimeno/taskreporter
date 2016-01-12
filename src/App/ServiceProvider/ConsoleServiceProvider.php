<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use JGimeno\TaskReporter\App\Console;

class ConsoleServiceProvider extends AbstractServiceProvider
{

    /**
     * @var array
     */
    protected $provides = [
        'JGimeno\TaskReporter\App\Console\CreateTask',
        'JGimeno\TaskReporter\App\Console\ListTasks',
        'JGimeno\TaskReporter\App\Console\DeleteTask'
    ];


    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $this->getContainer()->add('JGimeno\TaskReporter\App\Console\CreateTask')
            ->withArgument('JGimeno\TaskReporter\App\Command\AddTaskHandler');

        $this->getContainer()->add('JGimeno\TaskReporter\App\Console\ListTasks')
            ->withArgument('JGimeno\TaskReporter\App\Command\ListTasksHandler');

        $this->getContainer()->add('JGimeno\TaskReporter\App\Console\DeleteTask')
            ->withArgument('JGimeno\TaskReporter\App\Command\DeleteTaskHandler');
    }
}