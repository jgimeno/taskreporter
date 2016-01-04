<?php

namespace JGimeno\TaskReporter\App\Console;

use League\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

class ContainerAwareCommand extends Command
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        if (null === $this->container) {
            $this->container = $this->getApplication()->getContainer();
        }

        return $this->container;
    }
}
