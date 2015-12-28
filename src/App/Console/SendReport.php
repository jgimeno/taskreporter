<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\SendReport as SendReportCommand;
use JGimeno\TaskReporter\App\Command\SendReportHandler;
use JGimeno\TaskReporter\Infrastructure\Mail\MailOptions;
use JGimeno\TaskReporter\Infrastructure\Mail\PhpMailerMailProvider;
use League\Container\ContainerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendReport extends Command
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('taskReporter:send')
            ->setDescription('Send the report of the day.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mailOptions = new MailOptions("", "", "");

        $commandHandler = new SendReportHandler(
            new PhpMailerMailProvider(new PHPMailer(), $mailOptions),
            $this->container->get('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface')
        );

        $commandHandler->handle(new SendReportCommand());
    }
}
