<?php

namespace JGimeno\TaskReporter\Presentation\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;

interface MailTemplateInterface
{
    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string The subject.
     */
    public function renderSubject(WorkingDay $day);

    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string the body.
     */
    public function renderBody(WorkingDay $day);
}
