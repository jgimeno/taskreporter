<?php

namespace JGimeno\TaskReporter\Infrastructure\DoctrineTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use JGimeno\TaskReporter\Domain\Value\TaskDescription as TaskDescriptionValueObject;

class TaskDescription extends Type
{

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'description';
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return "task_description";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new TaskDescriptionValueObject($value);
    }


}