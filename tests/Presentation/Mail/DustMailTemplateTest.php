<?php

namespace JGimeno\TaskReporter\Tests\Presentation\Mail;

use Dust\Dust;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Presentation\Mail\DustMailTemplate;

class DustMailTemplateTest extends \PHPUnit_Framework_TestCase
{

    public function testItReturnsTheRenderedTemplateUsingFile()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());

        $taskWithTicket = new Task("#1234# Task with ticket.");
        $taskWithoutTicket = new Task("Task without ticket.");

        $workingDay->addTask($taskWithTicket);
        $workingDay->addTask($taskWithoutTicket);

        $templateRender = new DustMailTemplate(
            new Dust(),
            __DIR__."/files/testtemplate.dust",
            'Daily Report #date# for Manolo'
        );

        $template = $templateRender->renderBody($workingDay);

        $expectedTemplate = <<<TEXT
<h1>Today I did</h1>


  <li>(1234) Task with ticket.</li>


  <li>Task without ticket.</li>
TEXT;

        $expectedSubject = 'Daily Report '.date('Y-m-d').' for Manolo';

        $this->assertEquals($expectedSubject, $templateRender->renderSubject($workingDay));

        $this->assertEquals($expectedTemplate, $template);
    }
}
