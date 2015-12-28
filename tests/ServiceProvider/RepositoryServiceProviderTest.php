<?php

namespace JGimeno\TaskReporter\Tests\ServiceProvider;


use League\Container\Container;

class RepositoryServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        global $container;
        $this->container = $container;
    }

    public function testDoctrineEntityManagerExistsInContainer()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->container->get('entityManager'));
    }


    public function testDependencyInjectionOfWorkingDayRepository()
    {

        $this->assertInstanceOf(
            'JGimeno\TaskReporter\Infrastructure\DoctrineWorkingDayRepository',
            $this->container->get('JGimeno\TaskReporter\Entity\WorkingDayRepositoryInterface')
        );

    }
}