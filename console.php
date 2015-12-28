#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add($container->get('JGimeno\TaskReporter\App\Console\CreateTask'));

$application->add($container->get('JGimeno\TaskReporter\App\Console\ListTasks'));

$application->run();
