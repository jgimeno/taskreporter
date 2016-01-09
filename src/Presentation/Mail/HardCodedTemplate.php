<?php

namespace JGimeno\TaskReporter\Presentation\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;

class HardCodedTemplate implements MailTemplateInterface
{
    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string The subject.
     */
    public function renderSubject(WorkingDay $day)
    {
        return "Tasks for " . $day->getDate();
    }

    /**
     * Renders the body of the email.
     *
     * @param WorkingDay $day
     * @return string the body.
     */
    public function renderBody(WorkingDay $day)
    {
        $body = "";

        $tasks = $day->getTasks();

        foreach ($tasks as $task) {
            $body .= $task . "\n";
        }

        return $body;
    }
}
