<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use Carbon\Carbon;

interface WorkingDayRepositoryInterface
{
    public function getByDate(Carbon $date);

    public function save(WorkingDay $workingDay);
}