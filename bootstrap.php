<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\Container;

require_once 'vendor/autoload.php';

$container = new Container();

$isDevMode = true;

$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yml/"), $isDevMode);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);

$container->share('entityManager', function () use ($conn, $config) {
    return EntityManager::create($conn, $config);
});

$container
    ->add('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface', 'JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository')
    ->withArgument($container->get('entityManager'));

$container
    ->add('JGimeno\TaskReporter\App\Command\AddTaskHandler', function () use ($container) {
        return new \JGimeno\TaskReporter\App\Command\AddTaskHandler($container->get('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface'));
    });

$container->add('JGimeno\TaskReporter\App\Console\CreateTask', function () use ($container) {
    return new \JGimeno\TaskReporter\App\Console\CreateTask('taskReporter:add', $container->get('JGimeno\TaskReporter\App\Command\AddTaskHandler'));
});

$container
    ->add('JGimeno\TaskReporter\App\Command\ListTasksHandler', function () use ($container) {
        return new \JGimeno\TaskReporter\App\Command\ListTasksHandler($container->get('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface'));
    });

$container->add('JGimeno\TaskReporter\App\Console\ListTasks', function () use ($container) {
    return new \JGimeno\TaskReporter\App\Console\ListTasks('taskReporter:list', $container->get('JGimeno\TaskReporter\App\Command\ListTasksHandler'));
});