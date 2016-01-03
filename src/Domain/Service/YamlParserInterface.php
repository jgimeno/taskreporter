<?php

namespace JGimeno\TaskReporter\Domain\Service;

interface YamlParserInterface
{
    /**
     * @param $file
     * @return mixed
     */
    public function parse($file);
}