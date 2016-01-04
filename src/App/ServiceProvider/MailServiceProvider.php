<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use JGimeno\TaskReporter\Domain\Value\Password;
use JGimeno\TaskReporter\Infrastructure\Mail\MailOptions;
use JGimeno\TaskReporter\Infrastructure\Mail\PhpMailerMailProvider;
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
        $mailOptions = new MailOptions("", "", new Password(""));

        $mailProvider = new PhpMailerMailProvider(new PHPMailer(), $mailOptions);

        $this->getContainer()->add('JGimeno\TaskReporter\Domain\Service\MailProviderInterface', $mailProvider);
    }
}