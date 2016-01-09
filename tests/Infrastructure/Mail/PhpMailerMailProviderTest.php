<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Value\Password;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;
use JGimeno\TaskReporter\Infrastructure\Mail\MailOptions;
use JGimeno\TaskReporter\Infrastructure\Mail\PhpMailerMailProvider;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerMailProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $mockTemplate;

    protected function setUp()
    {
        parent::setUp();

        $this->mockTemplate = $this->getMockBuilder('JGimeno\TaskReporter\Presentation\Mail\MailTemplateInterface')
            ->getMock();
    }


    public function testItEchoesMailSendWhenItIsCorrect()
    {
        $mockPHPMailer = $this->getMockBuilder(PHPMailer::class)
            ->getMock();

        $mockPHPMailer->expects($this->once())
            ->method('send')
            ->willReturn(true);

        $this->mockTemplate->expects($this->once())
            ->method('renderSubject');

        $this->mockTemplate->expects($this->once())
            ->method('renderBody');

        $mailOptions = new MailOptions('hola', 'este', new Password('es'), "", "");

        $phpmailer = new PhpMailerMailProvider($mockPHPMailer, $mailOptions, $this->mockTemplate);
        $phpmailer->sendReportOf(new WorkingDay(WorkingDayId::generate()));
    }

    /**
     * @expectedException JGimeno\TaskReporter\Infrastructure\Exception\MailProviderException
     * @expectedExceptionMessage Error with mail provider:
     */
    public function testItFailsWhenThereIsAProblemWithPhpMailerClient()
    {
        $mockPHPMailer = $this->getMockBuilder(PHPMailer::class)
            ->getMock();

        $mockPHPMailer->expects($this->once())
            ->method('send')
            ->willThrowException(new Exception());

        $this->mockTemplate->expects($this->once())
            ->method('renderSubject');

        $this->mockTemplate->expects($this->once())
            ->method('renderBody');

        $mailOptions = new MailOptions('hola', 'este', new Password('es'), "", "");

        $phpmailer = new PhpMailerMailProvider($mockPHPMailer, $mailOptions, $this->mockTemplate);
        $phpmailer->sendReportOf(new WorkingDay(WorkingDayId::generate()));
    }

    public function testItAddsEveryToEmailsItFindsToSend()
    {
        $expectedCCs = ["mail1@gmail.com", "mail2@gmail.com"];

        $mailOptions = new MailOptions('hola', 'este', new Password('es'), "", $expectedCCs);

        $mockPHPMailer = $this->getMockBuilder(PHPMailer::class)
            ->getMock();

        $mockPHPMailer->expects($this->exactly(2))
            ->method('addCC')
            ->withConsecutive(
                ["mail1@gmail.com"],
                ["mail2@gmail.com"]
            );

        new PhpMailerMailProvider($mockPHPMailer, $mailOptions, $this->mockTemplate);
    }
}
