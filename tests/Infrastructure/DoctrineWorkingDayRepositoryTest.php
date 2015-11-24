<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure;

use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository;

class DoctrineWorkingDayRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected $em;

    protected function setUp()
    {
        global $em;

        parent::setUp();

        $this->em = $em;
    }


    public function testInstanceOf()
    {
        $repo = new DoctrineWorkingDayRepository($this->em);
        $this->assertInstanceOf('JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository', $repo);
    }

    public function testCreatingWorkingDayAndRetrievingItReturnsSame()
    {
        $workingDay = new WorkingDay();

        $task = new Task('Going to the bathroom.');
        $workingDay->addTask($task);

        $repo = new DoctrineWorkingDayRepository($this->em);
        $repo->add($workingDay);
    }
}
