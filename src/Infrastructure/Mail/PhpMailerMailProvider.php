<?php

namespace JGimeno\TaskReporter\Infrastructure\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Service\MailProviderInterface;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerMailProvider implements MailProviderInterface
{
    /**
     * @var PHPMailer
     */
    private $mailClient;
    /**
     * @var MailOptions
     */
    private $options;

    /**
     * PhpMailerMailProvider constructor.
     * @param PHPMailer $mailClient
     * @param MailOptions $options
     */
    public function __construct(PHPMailer $mailClient, MailOptions $options)
    {
        $this->mailClient = $mailClient;
        $this->options = $options;

        $this->setOptions();
    }

    /**
     * Sends a report of the working day.
     * @param WorkingDay $day
     */
    public function sendReportOf(WorkingDay $day)
    {
        if (!$this->mailClient->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mailClient->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    private function setOptions()
    {
        $this->mailClient->isSMTP();
        $this->mailClient->SMTPAuth = true;

        $this->mailClient->SMTPDebug = 2;

        $this->mailClient->Host = $this->options->getHost();

        $this->mailClient->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mailClient->Port = $this->options->getPort();

        $this->mailClient->setFrom('jgimeno@gmail.com', 'Mailer');
        $this->mailClient->addAddress('jgimeno@gmail.com', 'Joe User');     // Add a recipient

        $this->mailClient->Username = $this->options->getUserName();                 // SMTP username
        $this->mailClient->Password = $this->options->getPassword();

        $this->mailClient->Subject = 'Here is the subject';
        $this->mailClient->Body = 'This is the HTML message body <b>in bold!</b>';
    }
}
