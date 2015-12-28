<?php

namespace JGimeno\TaskReporter\Domain\Service;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;

interface MailProviderInterface
{
    /**
     * Sends a report of the working day.
     * @param WorkingDay $day
     * @throws MailProviderInterface
     */
    public function sendReportOf(WorkingDay $day);
}
