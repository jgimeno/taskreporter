<?php

namespace JGimeno\TaskReporter\App\ServiceProvider;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use JGimeno\TaskReporter\Infrastructure\DoctrineTypes\TaskDescription;
use JGimeno\TaskReporter\Infrastructure\Persistence\DoctrineWorkingDayRepository;
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
            array(__DIR__."/../../../config/orm/"),
            $this->container->get('isDevMode')
        );

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../../../db.sqlite',
        );

        $this->entityManager = EntityManager::create(
            $conn,
            $config
        );


        if (!Type::hasType("task_description")) {

            Type::addType(
                'task_description',
                TaskDescription::class
            );

            $this->entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('description',
                'task_description');
        }

        $this->getContainer()->add('entityManager', $this->entityManager);

        $this->getContainer()
            ->add(
                'JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface',
                DoctrineWorkingDayRepository::class
            )
            ->withArgument($this->entityManager);
    }
}
