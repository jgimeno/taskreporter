<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use JGimeno\TaskReporter\Domain\Value\Password;
use JGimeno\TaskReporter\Infrastructure\Mail\MailOptions;
use JGimeno\TaskReporter\Infrastructure\Mail\PhpMailerMailProvider;
use JGimeno\TaskReporter\Presentation\Mail\HardCodedTemplate;
use League\Container\ServiceProvider\AbstractServiceProvider;
use PHPMailer\PHPMailer\PHPMailer;

class MailServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'JGimeno\TaskReporter\Domain\Service\MailProviderInterface'
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
        $configProvider = $this
            ->getContainer()
            ->get('JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface');

        $mailOptions = new MailOptions(
            $configProvider->getConfiguration('mail.host'),
            $configProvider->getConfiguration('mail.username'),
            new Password($configProvider->getConfiguration('mail.password')),
            $configProvider->getConfiguration('mail.from'),
            $configProvider->getConfiguration('mail.to')
        );

        $mailProvider = new PhpMailerMailProvider(new PHPMailer(), $mailOptions, new HardCodedTemplate());

        $this->getContainer()->add('JGimeno\TaskReporter\Domain\Service\MailProviderInterface', $mailProvider);
    }
}