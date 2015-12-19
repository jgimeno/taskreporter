<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
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

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getDate()
    {
        return $this->date;
    }
}
