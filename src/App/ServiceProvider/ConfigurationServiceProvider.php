<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use JGimeno\TaskReporter\Infrastructure\Configuration\YamlParserProvider;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Symfony\Component\Yaml\Parser;

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
            function () {
                return new YamlParserProvider(new Parser());
            }
        );

        $this->getContainer()->share(
            'JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface',
            'JGimeno\TaskReporter\Infrastructure\Configuration\YamlConfigurationProvider'
        )->withArgument('JGimeno\TaskReporter\Domain\Service\YamlParserInterface')->withArgument(
            '../config/settings.yml'
        );

    }
}
