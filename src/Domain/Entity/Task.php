<?php

namespace JGimeno\TaskReporter\Domain\Entity;

use JGimeno\TaskReporter\Domain\Exception\TaskEmptyException;
use JGimeno\TaskReporter\Domain\Value\TaskDescription;

class Task
{
    const TICKET_DELIMITER = '#';

    protected $id;

    protected $description;

    protected $ticket;

    protected $workingDay;

    public function __construct($task = null)
    {
        if ($task == null) {
            throw new TaskEmptyException();
        }

        $this->parseTask($task);
    }

    /**
     * Parses description extracting ticket if it exists.
     *
     * @param $description
     */
    private function parseTask($description)
    {
        $this->extractTicket($description);
        $this->extractDescription($description);
    }

    /**
     * Extracts ticket if it exists.
     *
     * @param $description
     */

    private function extractTicket($description)
    {
        $output = null;
        $this->ticket = "";

        preg_match('~' . self::TICKET_DELIMITER . '(.*?)' . self::TICKET_DELIMITER . '~', $description, $output);

        if (isset($output[1])) {
            $this->ticket = $output[1];
        }
    }

    /**
     * @param $description
     */
    private function extractDescription($description)
    {
        $endDelimiterPosition = strrpos($description, self::TICKET_DELIMITER);

        $endDelimiterPosition++; // Offset of 1 to not include delimiter

        $this->description = new TaskDescription(trim(substr($description, $endDelimiterPosition)));
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $workingDay
     */
    public function setWorkingDay($workingDay)
    {
        $this->workingDay = $workingDay;
    }

    public function __toString()
    {
        $return = "";

        if ($this->getTicket()) {
            $return .= "(". $this->getTicket() .") ";
        }

        return $return . $this->getDescription();
    }
}
