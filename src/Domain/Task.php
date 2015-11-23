<?php

namespace JGimeno\TaskReporter\Domain;

use JGimeno\TaskReporter\Domain\Exception\TaskEmptyException;

class Task
{
    const TICKET_DELIMITER = '#';
    protected $description;
    protected $ticket;

    public function __construct($task = null)
    {
        if ($task == null) {
            throw new TaskEmptyException();
        }

        $this->parseTask($task);
    }

    /**
     * Parses descrition extracting ticket if it exists.
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
        preg_match('~' . self::TICKET_DELIMITER . '(.*?)' . self::TICKET_DELIMITER . '~', $description, $output);
        $this->ticket = $output[1];
    }

    /**
     * @param $description
     */
    private function extractDescription($description)
    {
        $endDelimiterPosition = strrpos($description, self::TICKET_DELIMITER);

        $endDelimiterPosition++; // Offset of 1 to not include delimiter

        $this->description = trim(substr($description, $endDelimiterPosition));
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTicket()
    {
        return $this->ticket;
    }
}
