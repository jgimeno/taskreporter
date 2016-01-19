<?php

namespace JGimeno\TaskReporter\Domain\Service;

interface YamlWriterInterface
{
    /**
     * @param $path string
     * @param $array array
     * @return int
     */
    public function write($path, $array);
}