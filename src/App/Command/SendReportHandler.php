<?php

namespace JGimeno\TaskReporter\App\Command;

use Carbon\Carbon;
use JGimeno\TaskReporter\Domain\Entity\WorkingDayRepositoryInterface;
use JGimeno\TaskReporter\Domain\Exception\EmptyWorkingDayException;
use JGimeno\TaskReporter\Domain\Service\MailProviderInterface;

class SendReportHandler
{
    /**
     * @var MailProviderInterface
     */
    private $mailProvider;
    /**
     * @var WorkingDayRepositoryInterface
     */
    private $repo;

    /**
     * SendReportHandler constructor.
     * @param MailProviderInterface $mailProvider
     * @param WorkingDayRepositoryInterface $repo
     */
    public function __construct(MailProviderInterface $mailProvider, WorkingDayRepositoryInterface $repo)
    {
        $this->mailProvider = $mailProvider;
        $this->repo = $repo;
    }

    public function handle(SendReport $command)
    {
        $workingDay = $this->repo->getByDate(Carbon::today('Europe/Madrid'));

        if (!$workingDay) {
            throw new EmptyWorkingDayException();
        }

        $this->mailProvider->sendReportOf($workingDay);
    }
}
