<?php

namespace JGimeno\TaskReporter\Infrastructure\Mail;

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
     * MailOptions constructor.
     */
    public function __construct($host, $userName, $password, $port = 587)
    {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->port = $port;
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
}
