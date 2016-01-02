<?php

namespace JGimeno\TaskReporter\Domain\Service;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\Exception\MailProviderException;

interface MailProviderInterface
{
    /**
     * Sends a report of the working day.
     * @param WorkingDay $day
     * @throws MailProviderException
     */
    public function sendReportOf(WorkingDay $day);
}
