<?php

namespace JGimeno\TaskReporter\Tests\Infrastructure\Configuration;

use JGimeno\TaskReporter\Infrastructure\Configuration\YamlWriterProvider;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Symfony\Component\Yaml\Exception\DumpException;

class YamlWriterProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mockWriter;

    /**
     * @var vfsStreamDirectory
     */
    protected $root;


    protected function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('settings');

        $this->mockWriter = $this->getMockBuilder('Symfony\Component\Yaml\Dumper')
            ->getMock();
    }

    public function testInstanceOf()
    {
        $yamlWriterProvider = new YamlWriterProvider($this->mockWriter);

        $this->assertInstanceOf('JGimeno\TaskReporter\Domain\Service\YamlWriterInterface', $yamlWriterProvider);
    }

    /**
     * @depends testInstanceOf
     */
    public function testWriteIsWritingYamlIntoFile()
    {
        $yamlWriterProvider = new YamlWriterProvider($this->mockWriter);


        $this->mockWriter->expects($this->once())
            ->method('dump')
            ->with(array('result' => false))
            ->willReturn('result: false');

        $yamlWriterProvider->write(vfsStream::url('settings/config.yml'), array('result' => false));

        $this->assertTrue($this->root->hasChild('settings/config.yml'));
     }

    public function testWriteFailsWhenThereIsAProblemWithSymfonyYamlDumper()
    {
        $yamlWriterProvider = new YamlWriterProvider($this->mockWriter);

        $this->mockWriter->expects($this->once())
            ->method('dump')
            ->with(array('result' => false))
            ->willThrowException(new DumpException());


        $this->setExpectedException('JGimeno\TaskReporter\Infrastructure\Exception\YamlProviderException');

        $yamlWriterProvider->write(vfsStream::url('settings/config.yml'), array('result' => false));
    }

}