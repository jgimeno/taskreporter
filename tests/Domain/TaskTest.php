<?php

namespace JGimeno\TaskReporter\Tests\Domain\Task;

use JGimeno\TaskReporter\Domain\Task;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException JGimeno\TaskReporter\Domain\Exception\TaskEmptyException
     */
    public function testATaskCannotBeEmpty()
    {
        $task = new Task();
    }

    public function testRetrieveNameReturnsTaskName()
    {
        $expectedTaskName = "Empty mailbox.";

        $task = new Task($expectedTaskName);
        $this->assertEquals($expectedTaskName, $task->getDescription());
    }

    public function testWeCanDefineRelatedTicketInDescription()
    {
        $taskNameWithTicketId = "#12345# Empty Mailbox.";

        $taskWithTicketId = new Task($taskNameWithTicketId);

        $this->assertEquals('12345', $taskWithTicketId->getTicket());
        $this->assertEquals('Empty Mailbox.', $taskWithTicketId->getDescription());
    }
}
