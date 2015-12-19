<?php

namespace JGimeno\TaskReporter\Presentation;

use Doctrine\Common\Collections\ArrayCollection;
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

    public function render($tasks)
    {
        foreach ($tasks as $task) {
            $this->output->writeln($task->getDescription());
        }
    }
}
