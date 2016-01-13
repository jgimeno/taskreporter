<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use JGimeno\TaskReporter\Domain\Exception\DomainException;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;

class WorkingDay
{
    /**
     * @var WorkingDayId
     */
    protected $id;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var ArrayCollection
     */
    private $tasks;

    public function __construct(WorkingDayId $id)
    {
        $this->id = $id;
        $this->date = Carbon::now('Europe/Madrid')->toDateString();
        $this->tasks = new ArrayCollection();
    }

    public function addTask(Task $task)
    {
        $task->setWorkingDay($this);

        $this->tasks->add($task);
    }

    /**
     * @param string $description
     */
    public function deleteTaskWithDescription($description)
    {
        $this->tasks->removeElement($this->getTaskByDescription($description));
    }

    /**
     * @param string $description
     * @return mixed
     * @throws DomainException
     */
    public function getTaskByDescription($description)
    {
        $tasksFound = $this->tasks->filter(
            function (Task $task) use ($description) {
                return $description === $task->getDescription();
            }
        );

        if ($tasksFound->isEmpty()) {
            throw new DomainException('Task '.$description.' does not exist in working day');
        }

        if ($tasksFound->count() > 1) {
            throw new DomainException('There is more than one task with description: '.$description);
        }

        return $tasksFound->first();
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getDate()
    {
        return $this->date;
    }
}
