<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\Persistence\DoctrineWorkingDayRepository;

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

    protected function setUp()
    {
        global $container;

        parent::setUp();

        $this->em = $container->get('entityManager');

        $this->repo = new DoctrineWorkingDayRepository($this->em);
        $this->workingDayWithTask = $this->getWorkingDayWithTask();
    }

    /**
     * Tests that getting a task from repo that does not exists by date returns null.
     */
    public function testRepoReturnsNullIfNotWorkingDayWithThatDayExists()
    {
        $this->repo->add($this->workingDayWithTask);

        $nullWorkingDay = $this->repo->getByDate(Carbon::tomorrow('Europe/Madrid'));
        $this->assertNull($nullWorkingDay);

        $this->repo->remove($this->workingDayWithTask);
    }

    /**
     *
     */
    public function testCreatingWorkingDayAndRetrievingItReturnsSame()
    {
        $this->repo->add($this->workingDayWithTask);

        $workingDayFromRepo = $this->repo->getByDate(Carbon::now('Europe/Madrid'));

        $this->assertEquals($workingDayFromRepo->getDate(), $this->workingDayWithTask->getDate());

        $this->repo->remove($this->workingDayWithTask);
    }

    /**
     * @return WorkingDay
     */
    private function getWorkingDayWithTask()
    {
        $workingDay = new WorkingDay($this->repo->nextIdentity());
        $workingDay->addTask(new Task('Going to the bathroom.'));
        return $workingDay;
    }
}
