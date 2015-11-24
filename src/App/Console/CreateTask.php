<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\AddTask;
use JGimeno\TaskReporter\App\Command\AddTaskHandler;
use JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTask extends Command
{
    protected function configure()
    {
        $this
            ->setName('taskReporter:add')
            ->setDescription('Add a task to your daily report.')
            ->addArgument(
                'task',
                InputArgument::REQUIRED,
                'Who do you want to greet?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $em; // Todo better injection of entity manager.

        $task = $input->getArgument('task');

        $command = new AddTask($task);

        $commandHandler = new AddTaskHandler(new DoctrineWorkingDayRepository($em));

        $commandHandler->handle($command);

        $output->writeln("Task added.");
    }

}