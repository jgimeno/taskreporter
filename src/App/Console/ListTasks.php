<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\ListTasks as ListTasksCommand;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\Presentation\ListTasks as ListTasksPresentation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTasks extends Command
{
    /**
     * @var ListTasksHandler
     */
    private $commandHandler;


    public function __construct($name, ListTasksHandler $listTasksHandler)
    {
        parent::__construct($name);

        $this->commandHandler = $listTasksHandler;
    }

    protected function configure()
    {
        $this->setDescription('Lists the tasks of the day.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->commandHandler->handle(new ListTasksCommand());

        $listTasksPresentation = new ListTasksPresentation($output);

        $listTasksPresentation->render($tasks);
    }
}
