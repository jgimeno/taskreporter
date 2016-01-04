<?php

namespace JGimeno\TaskReporter\ServiceProvider;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\ServiceProvider\AbstractServiceProvider;

class RepositoryServiceProvider extends AbstractServiceProvider
{
    private $entityManager;

    /**
     * @var array
     */
    protected $provides = [
        'entityManager',
        'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface'
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $config = Setup::createYAMLMetadataConfiguration(
            array(__DIR__."/../../config/orm/"),
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

        $this->getContainer()
            ->add(
                'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface',
                'JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository'
            )
            ->withArgument($this->entityManager);
    }
}