<?php

namespace JGimeno\TaskReporter\App\Command;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;

class DeleteTask
{
    /**
     * @var string
     */
    protected $description;

    /**
     * DeleteTask constructor.
     * @param WorkingDay $workingDay
     * @param $description
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