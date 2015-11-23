<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Task;

class AddTaskHandler
{
    protected $workingDayRepo;

    public function __construct(WorkingDayRepositoryInterface $repo)
    {
        $this->workingDayRepo = $repo;
    }

    public function handle(AddTask $command)
    {
        $task = new Task($command->getTask());

        $workingDay = $this->workingDayRepo->getByDate(Carbon::now());

        if (!$workingDay) {
            $workingDay = new WorkingDay();
        }

        $workingDay->addTask($task);

        $this->workingDayRepo->save($workingDay);
    }
}
