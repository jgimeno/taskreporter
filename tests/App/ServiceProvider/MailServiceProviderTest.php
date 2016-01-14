<?php

namespace JGimeno\TaskReporter\Tests\ServiceProvider;

use JGimeno\TaskReporter\App\ServiceProvider\ConfigurationServiceProvider;
use JGimeno\TaskReporter\App\ServiceProvider\MailServiceProvider;
use League\Container\Container;

class MailServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        $this->container = new Container();
        $this->container->addServiceProvider(new ConfigurationServiceProvider());

    }

    public function testContainerHasInstantiatedAMailProviderInterface()
    {

        $mailServiceProvider = new MailServiceProvider();

        $mailServiceProvider->setContainer($this->container);

        $mailServiceProvider->register();

        $this->assertInstanceOf(
            'JGimeno\TaskReporter\Domain\Service\MailProviderInterface',
            $this->container->get('JGimeno\TaskReporter\Domain\Service\MailProviderInterface')
        );


    }
}