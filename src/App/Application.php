<?php

namespace JGimeno\TaskReporter\App;

use League\Container\ContainerInterface;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const VERSION = "0.1";

    const APP_NAME = "TaskReporter";

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct(self::APP_NAME, self::VERSION);
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
