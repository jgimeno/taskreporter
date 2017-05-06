<?php

namespace JGimeno\TaskReporter\App\Command;

class AddTask
{
    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function getTask()
    {
        return $this->task;
    }
}
