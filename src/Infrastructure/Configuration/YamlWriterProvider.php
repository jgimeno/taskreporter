<?php

namespace JGimeno\TaskReporter\Infrastructure\Configuration;

use JGimeno\TaskReporter\Domain\Service\YamlWriterInterface;
use JGimeno\TaskReporter\Infrastructure\Exception\YamlProviderException;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Exception\DumpException;

class YamlWriterProvider implements YamlWriterInterface
{

    private $writer;


    public function __construct(Dumper $dumper)
    {
        $this->writer = $dumper;
    }

/**
     */
    public function write($path, $array)
    {
        try {
            return file_put_contents($path, $this->writer->dump($array));
        } catch (DumpException $e) {
            throw new YamlProviderException($e->getMessage());
        }
    }

}