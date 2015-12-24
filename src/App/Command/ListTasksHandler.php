<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException;

class ListTasksHandler
{
    /**
     * @var WorkingDayRepositoryInterface
     */
    private $repo;

    /**
     * ListTasksHandler constructor.
     */
    public function __construct(WorkingDayRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function handle(ListTasks $command)
    {
        $workingDay = $this->repo->getByDate(Carbon::now());

        if (!$workingDay) {
            throw new EmptyWorkingDayException();
        }

        $tasks = $workingDay->getTasks();

        return $tasks;
    }
}