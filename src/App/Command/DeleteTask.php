<?php

namespace JGimeno\TaskReporter\App\Command;

class DeleteTask
{
    /**
     * @var string
     */
    protected $description;

    /**
     * DeleteTask constructor.
     * @param string $description
     */
    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}