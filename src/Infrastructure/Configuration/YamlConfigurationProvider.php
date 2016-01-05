<?php

namespace JGimeno\TaskReporter\Infrastructure\Configuration;

use JGimeno\TaskReporter\Domain\Service\ConfigurationProviderInterface;
use JGimeno\TaskReporter\Domain\Service\YamlParserInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class YamlConfigurationProvider implements ConfigurationProviderInterface
{
    const MAX_NESTING = 10;

    const SPACE_DELIMITER = ".";
    /**
     * @var YamlParserInterface
     */
    protected $yamlParser;

    /**
     * @var string
     */
    protected $configFile;


    private $config;

    /**
     * YamlConfigurationProvider constructor.
     * @param YamlParserInterface $yamlParserInterface
     * @param $configFile string
     */
    public function __construct(YamlParserInterface $yamlParserInterface, $configFile)
    {
        $this->yamlParser = $yamlParserInterface;
        $this->configFile = $configFile;
    }

    /**
     * @param null $item
     * @return mixed
     */
    public function getConfiguration($item = null)
    {
        $this->initializeConfig($this->configFile);

        return (is_null($item)) ? $this->config : $this->getConfigurationItem($item);
    }

    private function initializeConfig($configFile)
    {

        if ($this->config === null) {
            $this->config = $this->yamlParser->parse($configFile);
        }

        return $this->config;
    }

    private function getConfigurationItem($item)
    {
        $this->checkMaxNesting($item);

        $result = $this->config;
        $itemSpace = explode(self::SPACE_DELIMITER, $item);

        foreach ($itemSpace as $key) {
            if (!array_key_exists($key, $result)) {
                throw new Exception('Requested config item does not exist: '.$item);
            }

            $result = $result[$key];
        }

        return $result;

    }

    private function checkMaxNesting($item)
    {
        if (substr_count($item, self::SPACE_DELIMITER) >= self::MAX_NESTING) {
            throw new Exception('Maximum nesting in config file is '.self::MAX_NESTING);
        }
    }
}
