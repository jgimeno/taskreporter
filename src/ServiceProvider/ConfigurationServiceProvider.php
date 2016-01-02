<?php

namespace JGimeno\TaskReporter\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ConfigurationServiceProvider extends AbstractServiceProvider
{

    /**
     * @var array
     */
    protected $provides = [
        'JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface',
        'JGimeno\TaskReporter\Domain\Service\YamlParserInterface',
    ];

    public function register()
    {

        $this->getContainer()->add(
            'JGimeno\TaskReporter\Domain\Service\YamlParserInterface',
            'JGimeno\TaskReporter\Infrastructure\Configuration\YamlParserProvider'
        );

        $this->getContainer()->share(
            'JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface',
            'JGimeno\TaskReporter\Infrastructure\Configuration\YamlConfigurationProvider'
        )->withArgument('JGimeno\TaskReporter\Domain\Service\YamlParserInterface')->withArgument(
            '../config/settings.yml'
        );

    }
}
