<?php

namespace JGimeno\TaskReporter\Domain\Service;

interface ConfigurationProviderInterface
{
    /**
     * @param null $item
     * @return mixed
     */
    public function getConfiguration($item = null);
}
