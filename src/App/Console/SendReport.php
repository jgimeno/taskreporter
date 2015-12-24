<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\SendReport as SendReportCommand;
use JGimeno\TaskReporter\App\Command\SendReportHandler;
use JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository;
use JGimeno\TaskReporter\Infrastructure\Mail\MailOptions;
use JGimeno\TaskReporter\Infrastructure\Mail\PhpMailerMailProvider;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendReport extends Command
{
    protected function configure()
    {
        $this
            ->setName('taskReporter:send')
            ->setDescription('Send the report of the day.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $em; // Todo better injection of entity manager.

        $mailOptions = new MailOptions("", "", "");

        $commandHandler = new SendReportHandler(
            new PhpMailerMailProvider(new PHPMailer(), $mailOptions),
            new DoctrineWorkingDayRepository($em)
        );

        $commandHandler->handle(new SendReportCommand());
    }
}
