<?php

namespace JGimeno\TaskReporter\Infrastructure\Configuration;

use JGimeno\TaskReporter\Domain\Service\YamlParserInterface;
use Symfony\Component\Yaml\Parser;

class YamlParserProvider implements YamlParserInterface
{

    /**
     * @var Parser
     */
    private $parser;

    /**
     * YamlParserProvider constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $file
     * @return mixed
     */
    public function parse($file)
    {
        return $this->parser->parse(file_get_contents($file));
    }
}