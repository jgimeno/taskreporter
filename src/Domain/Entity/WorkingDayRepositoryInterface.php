<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;

interface WorkingDayRepositoryInterface
{
    /**
     * @return WorkingDayId
     */
    public function nextIdentity();

    /**
     * @param Carbon $date
     * @return WorkingDay
     */
    public function getByDate(Carbon $date);

    public function add(WorkingDay $workingDay);
}
