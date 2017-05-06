<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;

class CommandServiceProvider extends AbstractServiceProvider
{

    /**
     * @var array
     */
    protected $provides = [
        'JGimeno\TaskReporter\App\Command\ListTasksHandler',
        'JGimeno\TaskReporter\App\Command\AddTaskHandler',
        'JGimeno\TaskReporter\App\Command\SendReportHandler',
        'JGimeno\TaskReporter\App\Command\DeleteTaskHandler',
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $this->getContainer()->add('JGimeno\TaskReporter\App\Command\ListTasksHandler')
            ->withArgument('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface');

        $this->getContainer()->add('JGimeno\TaskReporter\App\Command\AddTaskHandler')
            ->withArgument('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface');

        $this->getContainer()->add('JGimeno\TaskReporter\App\Command\SendReportHandler')
            ->withArguments(
                [
                    'JGimeno\TaskReporter\Domain\Service\MailProviderInterface',
                    'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface'
                ]
            );

        $this->getContainer()->add('JGimeno\TaskReporter\App\Command\DeleteTaskHandler')
            ->withArgument('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface');
    }
}
