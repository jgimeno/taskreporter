#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use JGimeno\TaskReporter\App\Console\SendReport;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add($container->get('JGimeno\TaskReporter\App\Console\CreateTask'));

$application->add($container->get('JGimeno\TaskReporter\App\Console\ListTasks'));

$application->add(new SendReport($container));

$application->run();
