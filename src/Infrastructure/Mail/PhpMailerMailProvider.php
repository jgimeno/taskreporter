<?php

namespace JGimeno\TaskReporter\Infrastructure\Mail;

use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Service\MailProviderInterface;
use JGimeno\TaskReporter\Infrastructure\Exception\MailProviderException;
use JGimeno\TaskReporter\Presentation\Mail\MailTemplateInterface;
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
     * @var MailTemplateInterface
     */
    private $template;

    /**
     * PhpMailerMailProvider constructor.
     * @param PHPMailer $mailClient
     * @param MailOptions $options
     * @param MailTemplateInterface $template
     */
    public function __construct(PHPMailer $mailClient, MailOptions $options, MailTemplateInterface $template)
    {
        $this->mailClient = $mailClient;
        $this->options = $options;
        $this->template = $template;

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
        $this->mailClient->Subject = $this->template->renderSubject($day);
        $this->mailClient->Body = $this->template->renderBody($day);
        $this->mailClient->IsHTML(true);
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
