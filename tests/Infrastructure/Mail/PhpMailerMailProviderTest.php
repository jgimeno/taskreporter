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
    public function testItEchoesMailSendWhenItIsCorrect()
    {
        $mockPHPMailer = $this->getMockBuilder(PHPMailer::class)
            ->getMock();

        $mockPHPMailer->expects($this->once())
            ->method('send')
            ->willReturn(true);

        $mailOptions = new MailOptions('hola', 'este', new Password('es'), "");

        $phpmailer = new PhpMailerMailProvider($mockPHPMailer, $mailOptions);
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

        $mailOptions = new MailOptions('hola', 'este', new Password('es'), "");

        $phpmailer = new PhpMailerMailProvider($mockPHPMailer, $mailOptions);
        $phpmailer->sendReportOf(new WorkingDay(WorkingDayId::generate()));
    }
}
