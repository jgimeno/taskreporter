<?php

namespace JGimeno\TaskReporter\Infrastructure\Configuration;

use JGimeno\TaskReporter\Domain\Service\YamlParserInterface;
use JGimeno\TaskReporter\Infrastructure\Exception\YamlProviderException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Class YamlParserProvider
 * @package JGimeno\TaskReporter\Infrastructure\Configuration
 */
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
     * @throws YamlProviderException
     */
    public function parse($file)
    {
        try {
            return $this->parser->parse(file_get_contents($file));
        } catch (ParseException $e) {
            throw new YamlProviderException($e->getMessage());
        }
    }
}