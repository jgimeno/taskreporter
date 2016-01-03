<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure\Configuration;

use JGimeno\TaskReporter\Infrastructure\Configuration\YamlParserProvider;
use org\bovigo\vfs\vfsStream;

class YamlParserProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockParser;

    /**
     * @var
     */
    protected $root;


    protected function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('settings');

        $this->mockParser = $this->getMockBuilder('Symfony\Component\Yaml\Parser')
            ->getMock();
    }

    public function testInstanceOf()
    {
        $yamlParserProvider = new YamlParserProvider($this->mockParser);

        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Service\YamlParserInterface', $yamlParserProvider);

    }

    /**
     * @depends testInstanceOf
     */
    public function testParseIsReturningResultFromProvidedParser()
    {
        $yamlParserProvider = new YamlParserProvider($this->mockParser);

        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Service\YamlParserInterface', $yamlParserProvider);

        vfsStream::newFile('config.yml', 0777)
            ->withContent('this should be a yaml string')
            ->at($this->root);

        $this->mockParser->expects($this->once())
            ->method('parse')
            ->with('this should be a yaml string')
            ->willReturn(array('result' => 'result'));

        $this->assertEquals(
            array('result' => 'result'),
            $yamlParserProvider->parse(vfsStream::url('settings/config.yml'))
        );

    }

}