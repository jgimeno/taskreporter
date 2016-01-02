<?php

namespace JGimeno\TaskReporter\Presentation;

use Doctrine\Common\Collections\Collection;
use JGimeno\TaskReporter\Domain\Entity\Task;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ListTasks
 *
 * Class that shows a lists of tasks in selected output.
 */
class ListTasks
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * ListTasks constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param Collection $tasks
     */
    public function render(Collection $tasks)
    {
        /* @var $task Task */
        foreach ($tasks as $task) {
            $line = "";

            if ($task->getTicket()) {
                $line = "(" . $task->getTicket() . ") ";
            }

            $line .= $task->getDescription();

            $this->output->writeln($line);
        }
    }
}
