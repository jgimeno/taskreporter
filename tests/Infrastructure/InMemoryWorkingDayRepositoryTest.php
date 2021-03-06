<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class InMemoryWorkingDayRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InMemoryWorkingDayRepository
     */
    protected $inMemoryRepo;

    /**
     * @var WorkingDay
     */
    protected $workingDayWithTask;

    /**
     * Test that saving a task in the repo can be retrieved by date.
     */
    public function testATaskCanBeInsertedAndRetrievedByDate()
    {
        $this->workingDayWithTask = $this->getWorkingDayWithTask();

        $this->inMemoryRepo->add($this->workingDayWithTask);

        $workingDayFromRepo = $this->inMemoryRepo->getByDate(Carbon::now('Europe/Madrid'));

        $this->assertEquals($this->workingDayWithTask, $workingDayFromRepo);
    }

    /**
     * @return WorkingDay
     */
    private function getWorkingDayWithTask()
    {
        $workingDay = new WorkingDay(WorkingDayId::generate());
        $workingDay->addTask(new Task("Task test."));

        return $workingDay;
    }

    /**
     * Tests that getting a task from repo that does not exists by date returns null.
     */
    public function testRepoReturnsNullIfNotWorkingDayWithThatDayExists()
    {
        $this->workingDayWithTask = $this->getWorkingDayWithTask();

        $this->inMemoryRepo->add($this->workingDayWithTask);

        $nullWorkingDayFromRepo = $this->inMemoryRepo->getByDate(Carbon::tomorrow('Europe/Madrid'));

        $this->assertNull($nullWorkingDayFromRepo);
    }

    /**
     * Tests that updating a repo saving and retrieving means that we have
     * and updated version of the file.
     */
    public function testRepoUpdatesWorkDayIfNewIsAddedWithSameData()
    {
        $this->workingDayWithTask = $this->getWorkingDayWithTask();
        $this->inMemoryRepo->add($this->workingDayWithTask);

        $workingDayFromRepo = $this->inMemoryRepo->getByDate(Carbon::now('Europe/Madrid'));
        $this->assertSame($this->workingDayWithTask, $workingDayFromRepo);

        $workingDayFromRepo->addTask(new Task('Beber un poco de vino'));

        $workingDayFromRepo = $this->inMemoryRepo->getByDate(Carbon::now('Europe/Madrid'));
        $this->assertSame($this->workingDayWithTask, $workingDayFromRepo);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->inMemoryRepo = new InMemoryWorkingDayRepository();
        $this->workingDayWithTask = $this->getWorkingDayWithTask();
    }
}
