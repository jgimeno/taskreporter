<?php

namespace JGimeno\TaskReporter\Domain\Value;

use Ramsey\Uuid\Uuid;

class WorkingDayId extends ValueObject
{
    /**
     * WorkingDayId constructor.
     */
    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }

    public static function generate()
    {
        return new self(Uuid::uuid4());
    }
}
