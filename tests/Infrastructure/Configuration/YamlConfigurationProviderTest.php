<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure\Configuration;

use JGimeno\TaskReporter\Infrastructure\Configuration\YamlConfigurationProvider;

class YamlConfigurationProviderTest extends \PHPUnit_Framework_TestCase
{

    protected $mockParserProvider;

    public function testInstanceOf()
    {

        $yamlConfigProvider = new YamlConfigurationProvider($this->mockParserProvider, 'settings.yml');

        $this->assertInstanceOf(
            'JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface',
            $yamlConfigProvider
        );

    }

    public function testGetConfigurationReturnsExpectedValue()
    {
        $yamlConfigProvider = new YamlConfigurationProvider($this->mockParserProvider, 'settings.yml');

        $config = array('db' => array('entry_1' => 'mathias', 'entry_2' => 'verraes'));

        $this->mockParserProvider->expects($this->once())
            ->method('parse')
            ->with('settings.yml')
            ->willReturn($config);

        $this->assertEquals($config['db'], $yamlConfigProvider->getConfiguration('db'));

        $this->assertEquals($config['db']['entry_1'], $yamlConfigProvider->getConfiguration('db.entry_1'));
    }

    public function testGetConfigurationThrowsErrorWhenRequestedKeyIsTooDeep()
    {
        $yamlConfigProvider = new YamlConfigurationProvider($this->mockParserProvider, 'settings.yml');

        $config = array(
            'level_1' => array(
                'level_2' => array(
                    'level_3' => array(
                        'level_4' => array(
                            'level_5' => array(
                                'level_6' => array(
                                    'level_7' => array(
                                        'level_8' => array(
                                            'level_9' => array(
                                                'level_10' => array(
                                                    'level_11'=> 'asda'
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

        $this->mockParserProvider->expects($this->once())
            ->method('parse')
            ->with('settings.yml')
            ->willReturn($config);

        $this->setExpectedExceptionRegExp('\Exception', '/Maximum nesting in config file is .*/');

        $yamlConfigProvider->getConfiguration(
            'level_1.level_2.level_3.level_4.level_5.level_6.level_7.level_8.level_9.level_10.level_11'
        );
    }

    public function testGetConfigurationThrowsErrorWhenValueNotFound()
    {
        $yamlConfigProvider = new YamlConfigurationProvider($this->mockParserProvider, 'settings.yml');

        $this->mockParserProvider->expects($this->once())
            ->method('parse')
            ->with('settings.yml')
            ->willReturn([]);

        $this->setExpectedExceptionRegExp('\Exception', '/Requested config item does not exist: .*/');

        $yamlConfigProvider->getConfiguration('a');
    }

    protected function setUp()
    {
        parent::setUp();

        $this->mockParserProvider = $this->getMockBuilder('JGimeno\TaskReporter\Domain\Service\YamlParserInterface')
            ->getMock();
    }
}