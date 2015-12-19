<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\AddTask;
use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use JGimeno\TaskReporter\App\Command\ListTasks as ListTasksCommand;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository;
use JGimeno\TaskReporter\Presentation\ListTasks as ListTasksPresentation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTasks extends Command
{
    protected function configure()
    {
        $this
            ->setName('taskReporter:list')
            ->setDescription('Lists the tasks of the day.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $em; // Todo better injection of entity manager.

        $commandHandler = new ListTasksHandler(new DoctrineWorkingDayRepository($em));
        $tasks = $commandHandler->handle(new ListTasksCommand());

        $listTasksPresentation = new ListTasksPresentation($output);
        $listTasksPresentation->render($tasks);
    }
}
