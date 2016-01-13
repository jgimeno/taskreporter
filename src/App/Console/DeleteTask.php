<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\DeleteTask as DeleteTaskCommand;
use JGimeno\TaskReporter\App\Command\DeleteTaskHandler;
use JGimeno\TaskReporter\App\Command\ListTasksHandler;
use JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;


class DeleteTask extends Command
{
    /**
     * @var ListTasksHandler
     */
    private $listsTasksHandler;

    /**
     * @var DeleteTaskHandler
     */
    private $commandHandler;

    public function __construct(ListTasksHandler $listTasksHandler, DeleteTaskHandler $deleteTaskHandler)
    {
        parent::__construct();
        $this->listsTasksHandler = $listTasksHandler;
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
        $tasks = $this->listsTasksHandler->handle();

        $taskDescription = $this->showTasksToDelete($input, $output, $tasks);

        $this->commandHandler->handle(new DeleteTaskCommand($taskDescription));

        $output->writeln('You have just deleted: '.$taskDescription);
    }

    protected function showTasksToDelete(InputInterface $input, OutputInterface $output, $tasks)
    {
        $helper = $this->getHelper('question');

        $question = new ChoiceQuestion(
            'Please select the task that you want to delete',
            $tasks->toArray(),
            0
        );

        $question->setErrorMessage('Task %s does not exist.');

        return $helper->ask($input, $output, $question);
    }
}
