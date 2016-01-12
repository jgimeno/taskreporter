<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Exception\DomainException;
use JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException;

class DeleteTaskHandler
{
    /**
     * @var WorkingDayRepositoryInterface
     */
    private $repo;

    /**
     * @var WorkingDay
     */
    private $workingDay;

    /**
     * ListTasksHandler constructor.
     * @param WorkingDayRepositoryInterface $repo
     */
    public function __construct(WorkingDayRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return WorkingDay
     * @throws EmptyWorkingDayException
     */
    public function handleShowList()
    {
        $workingDay = $this->repo->getByDate(Carbon::now());

        if ($workingDay->getTasks()->isEmpty()) {
            throw new EmptyWorkingDayException();
        }

        $this->workingDay = $workingDay;

        return $workingDay;
    }

    public function handleDelete(DeleteTask $command)
    {

        $taskToDelete = $this->workingDay->getTaskByDescription($command->getDescription());

        if (!$taskToDelete) {
            throw new DomainException('The selected task does not exist for today');
        }

        $this->workingDay->deleteTask($taskToDelete);

        $this->repo->add($this->workingDay);
    }
}
