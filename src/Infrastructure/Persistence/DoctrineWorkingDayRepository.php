<?php

namespace JGimeno\TaskReporter\Infrastructure\Persistence;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use JGimeno\TaskReporter\Domain\Entity\WorkingDay;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Value\WorkingDayId;

class DoctrineWorkingDayRepository implements WorkingDayRepositoryInterface
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
        $repo = $this->em->getRepository('JGimeno\TaskReporter\Domain\Entity\WorkingDay');

        $return = $repo->findOneByDate($date->toDateString());

        return $return;
    }

    public function add(WorkingDay $workingDay)
    {
        $this->em->persist($workingDay);
        $this->em->flush();
    }

    public function remove($workingDay)
    {
        $this->em->remove($workingDay);
        $this->em->flush();
    }

    /**
     * @return WorkingDayId
     */
    public function nextIdentity()
    {
        return WorkingDayId::generate();
    }
}
