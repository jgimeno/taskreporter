<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;

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
     * @param ListTasks $command
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function handle(ListTasks $command)
    {
        $workingDay = $this->repo->getByDate(Carbon::now());
        $tasks = $workingDay->getTasks();
        return $tasks;
    }
}