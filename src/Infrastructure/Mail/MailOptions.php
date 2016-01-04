<?php

namespace JGimeno\TaskReporter\Infrastructure\Mail;

use JGimeno\TaskReporter\Domain\Value\Password;
use JGimeno\TaskReporter\Domain\Value\PortNumber;

class MailOptions
{
    private $host;

    private $userName;

    private $password;

    /**
     * @var int
     */
    private $port;
    /**
     * @var string
     */
    private $from;

    /**
     * MailOptions constructor.
     * @param $host
     * @param $userName
     * @param Password $password
     * @param string $from The address that appears
     * @param PortNumber $port
     */
    public function __construct($host, $userName, Password $password, $from, PortNumber $port = null)
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->port = $port;
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }
}
