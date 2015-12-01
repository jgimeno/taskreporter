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

    protected $date;

    private $tasks;

    public function __construct(WorkingDayId $id)
    {
        $this->id = $id;
        $this->date = Carbon::now('Europe/Madrid')->toDateString();
        $this->tasks = new ArrayCollection();
    }

    /**
     * @return WorkingDayId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function addTask(Task $task)
    {
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
