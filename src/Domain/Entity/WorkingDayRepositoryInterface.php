<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;

interface WorkingDayRepositoryInterface
{
    /**
     * @param Carbon $date
     * @return WorkingDay
     */
    public function getByDate(Carbon $date);

    public function add(WorkingDay $workingDay);
}