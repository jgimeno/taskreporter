<?php

namespace JGimeno\TaskReporter\App\Command;

class AddTask
{
    public function __construct($task)
    {
        $this->input = $task;
    }

    public function getTask()
    {
        return $this->task;
    }
}