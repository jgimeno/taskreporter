<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\AddTask;
use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTask extends Command
{
    /**
     * @var AddTaskHandler
     */
    private $commandHandler;

    public function __construct(AddTaskHandler $addTaskHandler)
    {
        parent::__construct();
        $this->commandHandler = $addTaskHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a task to your daily report.')
            ->setName('taskReporter:add')
            ->addArgument(
                'task',
                InputArgument::REQUIRED,
                'Who do you want to greet?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $task = $input->getArgument('task');

        $command = new AddTask($task);

        $this->commandHandler->handle($command);

        $output->writeln("Task added.");
    }

}