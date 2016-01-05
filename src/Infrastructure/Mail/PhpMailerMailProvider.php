<?php

namespace JGimeno\TaskReporter\Infrastructure\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Service\MailProviderInterface;
use JGimeno\TaskReporter\Infrastructure\Exception\MailProviderException;
use PHPMailer\PHPMailer\Exception;
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
     * @throws MailProviderException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendReportOf(WorkingDay $day)
    {
        try {
            $this->renderMail($day);

            $this->mailClient->send();
        } catch (Exception $ex) {
            throw new MailProviderException($ex->errorMessage());
        }
    }

    private function setOptions()
    {
        $this->mailClient->isSMTP();
        $this->mailClient->SMTPAuth = true;
        $this->mailClient->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mailClient->addAddress('jgimeno@gmail.com', 'Joe User');

        $this->mailClient->Host = $this->options->getHost();
        $this->mailClient->Username = $this->options->getUserName();
        $this->mailClient->Password = $this->options->getPassword();
        $this->mailClient->setFrom($this->options->getFrom());
        $this->mailClient->Port = $this->options->getPort();

        $this->addCCs();
    }

    private function renderMail(WorkingDay $day)
    {
        $this->mailClient->Subject = "Tasks for " . $day->getDate();

        $tasks = $day->getTasks();

        foreach ($tasks as $task) {
            $this->mailClient->Body .= $task . "\n";
        }
    }

    private function addCCs()
    {
        $emailsToAdd = $this->options->getTo();

        if (!empty($emailsToAdd)) {
            foreach ($this->options->getTo() as $to) {
                $this->mailClient->addCC($to);
            }
        }
    }
}
