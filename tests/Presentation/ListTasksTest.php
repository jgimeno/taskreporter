<?php

namespace JGimeno\TaskReporter\Presentation;

use Doctrine\Common\Collections\ArrayCollection;
use JGimeno\TaskReporter\Domain\Entity\Task;

class ListTasksTest extends \PHPUnit_Framework_TestCase
{
    protected $mockupOutput;

    protected function setUp()
    {
        parent::setUp();
        $this->mockupOutput = $this->getMockBuilder('Symfony\Component\Console\Output\OutputInterface')->getMock();
    }

    public function testShowingATaskThatHasNotTicket()
    {
        $tasksCollection = new ArrayCollection();

        $taskText = "Go to the toilet.";

        $taskWithoutTicket = new Task($taskText);
        $tasksCollection->add($taskWithoutTicket);

        $this->mockupOutput->expects($this->once())
            ->method('writeLn')
            ->with('* ' . $taskText);

        $listTasksPresentation = new ListTasks($this->mockupOutput);
        $listTasksPresentation->render($tasksCollection);
    }

    public function testShowingATaskThatHasATicketNumber()
    {
        $tasksCollection = new ArrayCollection();

        $taskTextWithTicket = "#1234# I am going to the doctor.";
        $tasksCollection->add(new Task($taskTextWithTicket));

        $this->mockupOutput->expects($this->once())
            ->method('writeLn')
            ->with("(1234) I am going to the doctor.");

        $listTasksPresentation = new ListTasks($this->mockupOutput);
        $listTasksPresentation->render($tasksCollection);
    }
}
