<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Value\TaskDescription;

class DeleteTaskHandler
{
    /**
     * @var WorkingDayRepositoryInterface
     */
    private $repo;

    /**
     * DeleteTaskHandler constructor.
     * @param WorkingDayRepositoryInterface $repo
     */
    public function __construct(WorkingDayRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function handle(DeleteTask $command)
    {
        $taskDescription = new TaskDescription($command->getDescription());

        $workingDay = $this->repo->getByDate(Carbon::now('Europe/Madrid'));

        $workingDay->deleteTaskWithDescription($taskDescription);

        $this->repo->add($workingDay);
    }
}
