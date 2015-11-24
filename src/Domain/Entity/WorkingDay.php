<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;

class WorkingDay
{
    protected $id;

    protected $date;

    private $tasks;

    public function __construct()
    {
        $this->date = Carbon::now('Europe/Madrid')->toDateString();
        $this->tasks = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addTask(Task $task)
    {
        $this->tasks->add($task);
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
