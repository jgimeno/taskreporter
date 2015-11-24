<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;

class WorkingDay
{

    protected $id;

    private $tasks;

    public function __construct()
    {
        $this->id = Carbon::now('Europe/Madrid')->toDateString();
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
}
