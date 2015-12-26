<?php


use JGimeno\TaskReporter\ServiceProvider\CommandServiceProvider;
use JGimeno\TaskReporter\ServiceProvider\ConsoleServiceProvider;
use JGimeno\TaskReporter\ServiceProvider\RepositoryServiceProvider;
use League\Container\Container;

require_once 'vendor/autoload.php';

$container = new Container();

$container->share('isDevMode', true);

$container
    ->addServiceProvider(new RepositoryServiceProvider())
    ->addServiceProvider(new CommandServiceProvider())
    ->addServiceProvider(new ConsoleServiceProvider());
