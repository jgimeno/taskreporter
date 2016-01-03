<?php

namespace ServiceProvider;


use JGimeno\TaskReporter\ServiceProvider\ConfigurationServiceProvider;
use League\Container\Container;

class ConfigurationServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigurationServiceProvider
     */
    protected $serviceProvider;

    /**
     * @@dataProvider expectedServicesProvider
     */
    public function testContainerIsCreatingNeededServices($service, $shared)
    {

        $container = new Container();

        $serviceProvider = new ConfigurationServiceProvider();

        $serviceProvider->setContainer($container);

        $serviceProvider->register();

        $this->assertInstanceOf($service, $container->get($service));

        if ($shared) {
            $this->assertSame($container->get($service), $container->get($service));
        } else {
            $this->assertNotSame($container->get($service), $container->get($service));
        }
    }

    /**
     * @return array
     */
    public function expectedServicesProvider()
    {
        return array(
            array('JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface', true),
            array('JGimeno\TaskReporter\Domain\Service\YamlParserInterface', false),
        );
    }


}