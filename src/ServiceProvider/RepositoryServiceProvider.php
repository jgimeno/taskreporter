<?php

namespace JGimeno\TaskReporter\ServiceProvider;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class RepositoryServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    private $entityManager;

    /**
     * @var array
     */
    protected $provides = [
        'entityManager',
        'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface'
    ];

    public function boot()
    {
        $config = Setup::createYAMLMetadataConfiguration(
            array(__DIR__."/../../config/yml/"),
            $this->container->get('isDevMode')
        );

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../../db.sqlite',
        );

        $this->entityManager = EntityManager::create(
            $conn,
            $config
        );

        $this->getContainer()->add('entityManager', $this->entityManager);
    }


    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $this->getContainer()
            ->add(
                'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface',
                'JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository'
            )
            ->withArgument($this->entityManager);
    }
}