<?php

namespace JGimeno\TaskReporter\App\Console;

use JGimeno\TaskReporter\App\Command\SendReport as SendReportCommand;
use JGimeno\TaskReporter\Infrastructure\Exception\InfrastructureException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendReport extends ContainerAwareCommand
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('taskReporter:send')
            ->setDescription('Send the report of the day.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {

            $commandHandler = $this
                ->getContainer()
                ->get('JGimeno\TaskReporter\App\Command\SendReportHandler');

            $commandHandler->handle(new SendReportCommand());

        } catch (InfrastructureException $ex) {
            $output->writeln('<error>' . $ex->getMessage() . '</error>');
        }
    }
}
