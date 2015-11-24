<?php

namespace JGimeno\TaskReporter\Infrastructure;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;

class DoctrineWorkingDayRepository implements  WorkingDayRepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getByDate(Carbon $date)
    {
        return $this->em->getById($date->toDateString());
    }

    public function add(WorkingDay $workingDay)
    {
        $this->em->persist($workingDay);
        $this->em->flush();
    }
}