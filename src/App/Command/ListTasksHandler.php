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
     * @param WorkingDayRepositoryInterface $repo
     */
    public function __construct(WorkingDayRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     * @throws EmptyWorkingDayException
     */
    public function handle()
    {
        $workingDay = $this->repo->getByDate(Carbon::now());

        if (!$workingDay || $workingDay->getTasks()->isEmpty()) {
            throw new EmptyWorkingDayException();
        }

        $tasks = $workingDay->getTasks();

        return $tasks;
    }
}