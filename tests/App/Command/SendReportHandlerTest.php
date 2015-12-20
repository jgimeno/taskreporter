<?php

namespace JGimeno\TaskReporter\Tests\App\Command;

use JGimeno\TaskReporter\App\Command\SendReport;
use JGimeno\TaskReporter\App\Command\SendReportHandler;
use JGimeno\TaskReporter\Domain\Entity\Task;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Infrastructure\InMemoryWorkingDayRepository;

class SendReportHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockMailProvider;

    protected function setUp()
    {
        parent::setUp();
        $this->mockMailProvider = $this->getMockBuilder('JGimeno\TaskReporter\Domain\Service\MailProviderInterface')
            ->getMock();
    }


    /**
     * @expectedException JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException
     */
    public function testItThrowsErrorWhenNoWorkingDayIsDefined()
    {
        $inMemoryRepo = new InMemoryWorkingDayRepository();

        $this->mockMailProvider->expects($this->never())
            ->method('sendReportOf');

        $sendReportHandler = new SendReportHandler($this->mockMailProvider, $inMemoryRepo);

        $sendReportHandler->handle(new SendReport());
    }

    public function testItWorksCorrectlyWhenYouHaveAWorkingDay()
    {
        $inMemoryRepo = new InMemoryWorkingDayRepository();
        $workingDay = new WorkingDay($inMemoryRepo->nextIdentity());

        $workingDay->addTask(new Task("Going to the toilet."));

        $inMemoryRepo->add($workingDay);

        $this->mockMailProvider->expects($this->once())
            ->method('sendReportOf')
            ->with($workingDay);

        $sendReportHandler = new SendReportHandler($this->mockMailProvider, $inMemoryRepo);
        $sendReportHandler->handle(new SendReport());
    }
}
