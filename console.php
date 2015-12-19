#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap.php';

use JGimeno\TaskReporter\App\Console\CreateTask;
use JGimeno\TaskReporter\App\Console\ListTasks;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new CreateTask());
$application->add(new ListTasks());
$application->run();
