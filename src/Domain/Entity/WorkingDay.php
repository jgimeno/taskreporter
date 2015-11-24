<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;

class WorkingDay
{
    protected $id;

    protected $tasks = array();

    public function __construct()
    {
        $this->id = Carbon::now('Europe/Madrid')->toDateString();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addTask(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function getTasks()
    {
        return $this->tasks;
    }
}
