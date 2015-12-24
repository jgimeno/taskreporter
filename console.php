#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use JGimeno\TaskReporter\App\Console\CreateTask;
use JGimeno\TaskReporter\App\Console\ListTasks;
use JGimeno\TaskReporter\App\Console\SendReport;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new CreateTask());
$application->add(new ListTasks());
$application->add(new SendReport());
$application->run();
