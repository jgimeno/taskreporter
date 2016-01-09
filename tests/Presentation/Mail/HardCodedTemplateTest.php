<?php

namespace JGimeno\TaskReporter\Tests\Presentation\Mail;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Presentation\Mail\HardCodedTemplate;

class HardCodedTemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testItRendersAWorkingDayBody()
    {
        $templateRenderer = new HardCodedTemplate();

        $workingDay = $this->createWorkingDayWithTwoTasks();

        $template = $templateRenderer->renderBody($workingDay);

        $expectedTemplate = <<<TEXT
Take a bath.
(1234) Take a pint.

TEXT;

        $this->assertEquals($expectedTemplate, $template);
    }

    public function testItRendersASubjectForWorkingDay()
    {
        $templateRenderer = new HardCodedTemplate();

        $workingDay = $this->createWorkingDayWithTwoTasks();

        $templateSubject = $templateRenderer->renderSubject($workingDay);

        $expectedSubject = "Tasks for " . Carbon::now('Europe/Madrid')->toDateString();

        $this->assertEquals($expectedSubject, $templateSubject);
    }

    /**
     * @return WorkingDay
     */
    private function createWorkingDayWithTwoTasks()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());

        $normalTask = new Task("Take a bath.");
        $taskWithTicket = new Task("#1234# Take a pint.");

        $workingDay->addTask($normalTask);
        $workingDay->addTask($taskWithTicket);

        return $workingDay;
    }
}
