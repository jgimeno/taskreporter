<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository;

class DoctrineWorkingDayRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected $em;

    /**
     * @var WorkingDay
     */
    protected $workingDayWithTask;

    /**
     * @var DoctrineWorkingDayRepository
     */
    protected $repo;

    /**
     * Tests that getting a task from repo that does not exists by date returns null.
     */
    public function testRepoReturnsNullIfNotWorkingDayWithThatDayExists()
    {
        $this->repo->add($this->workingDayWithTask);

        $nullWorkingDay = $this->repo->getByDate(Carbon::tomorrow());
        $this->assertNull($nullWorkingDay);

        $this->repo->remove($this->workingDayWithTask);
    }

    /**
     *
     */
    public function testCreatingWorkingDayAndRetrievingItReturnsSame()
    {
        $this->repo->add($this->workingDayWithTask);

        $workingDayFromRepo = $this->repo->getByDate(Carbon::now());

        $this->assertEquals($workingDayFromRepo->getDate(), $this->workingDayWithTask->getDate());
        $this->assertEquals($workingDayFromRepo->getId(), $this->workingDayWithTask->getId());

        $this->repo->remove($this->workingDayWithTask);
    }

    protected function setUp()
    {
        global $em;
        parent::setUp();
        $this->em = $em;

        $this->workingDayWithTask = $this->getWorkingDayWithTask();
        $this->repo = new DoctrineWorkingDayRepository($this->em);
    }

    /**
     * @return WorkingDay
     */
    private function getWorkingDayWithTask()
    {
        $workingDay = new WorkingDay();
        $workingDay->addTask(new Task('Going to the bathroom.'));

        return $workingDay;
    }
}
