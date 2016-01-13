<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;

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
        $workingDay = $this->repo->getByDate(Carbon::now());

        $workingDay->deleteTaskWithDescription($command->getDescription());

        $this->repo->add($workingDay);
    }
}
