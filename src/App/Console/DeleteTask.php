<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\DeleteTask as DeleteTaskCommand;
use JGimeno\TaskReporter\App\Command\DeleteTaskHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;


class DeleteTask extends Command
{
    /**
     * @var DeleteTaskHandler
     */
    private $commandHandler;

    public function __construct(DeleteTaskHandler $deleteTaskHandler)
    {
        parent::__construct();
        $this->commandHandler = $deleteTaskHandler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete a task from your daily report.')
            ->setName('taskReporter:delete');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $workingDay = $this->commandHandler->handleShowList();

            $helper = $this->getHelper('question');

            $question = new ChoiceQuestion(
                'Please select the task that you want to delete', $workingDay->getTasks()->toArray(),
                0
            );

            $question->setErrorMessage('Task %s does not exist.');

            $task = $helper->ask($input, $output, $question);

            $this->commandHandler->handleDelete(new DeleteTaskCommand($task));

            $output->writeln('You have just deleted: '.$task);
    }
}