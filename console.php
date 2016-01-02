#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use JGimeno\TaskReporter\App\Application;
use JGimeno\TaskReporter\App\Console\SendReport;

$application = new Application($container);

$application->add($container->get('JGimeno\TaskReporter\App\Console\CreateTask'));

$application->add($container->get('JGimeno\TaskReporter\App\Console\ListTasks'));

$application->add(new SendReport());

$application->run();
