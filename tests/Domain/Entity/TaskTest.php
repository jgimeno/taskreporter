<?php

namespace JGimeno\TaskReporter\Tests\Domain\Entity;

use JGimeno\TaskReporter\Domain\Entity\Task;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    const TASK_WITH_TICKET_ID = "#12345# Empty Mailbox.";

    const TASK_WITHOUT_TICKET_ID = "Empty Mailbox.";

    protected $taskWithoutTicketId;

    protected $taskWithTicketId;

    protected function setUp()
    {
        parent::setUp();
        $this->taskWithoutTicketId = new Task(self::TASK_WITHOUT_TICKET_ID);
        $this->taskWithTicketId = new Task(self::TASK_WITH_TICKET_ID);
    }

    /**
     * @expectedException JGimeno\TaskReporter\Domain\Exception\TaskEmptyException
     */
    public function testATaskCannotBeEmpty()
    {
        $task = new Task();
    }

    public function testRetrieveNameReturnsTaskName()
    {
        $this->assertEquals(self::TASK_WITHOUT_TICKET_ID, $this->taskWithoutTicketId->getDescription());
    }

    public function testWeCanDefineRelatedTicketInDescription()
    {
        $this->assertEquals('12345', $this->taskWithTicketId->getTicket());
        $this->assertEquals('Empty Mailbox.', $this->taskWithTicketId->getDescription());
    }

    public function testToString()
    {
        $this->assertEquals("(12345) Empty Mailbox.", (string) $this->taskWithTicketId);
        $this->assertEquals("Empty Mailbox.", (string) $this->taskWithoutTicketId);
    }
}
