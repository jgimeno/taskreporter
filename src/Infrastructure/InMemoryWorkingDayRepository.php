<?php

namespace JGimeno\TaskReporter\Infrastructure;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;

class InMemoryWorkingDayRepository implements WorkingDayRepositoryInterface
{
    protected $workingDays = array();

    public function getByDate(Carbon $date)
    {
        $return = null;

        if(isset($this->workingDays[$date->toDateString()])) {
            $return = $this->workingDays[$date->toDateString()];
        }

        return $return;
    }

    public function add(WorkingDay $workingDay)
    {
        $this->workingDays[$workingDay->getId()] = $workingDay;
    }
}