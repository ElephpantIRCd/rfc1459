<?php
namespace ElephpantIRCd\RFC1459;

use ElephpantIRCd\Connection;
use ElephpantIRCd\RFC1459\Message\AbstractMessage;
use ElephpantIRCd\Server;

class TriggerContainer
{
    protected $server;
    protected $connection;
    protected $message;

    public function __construct(Server $server, Connection $connection, AbstractMessage $message)
    {
        $this->server = $server;
        $this->connection = $connection;
        $this->message = $message;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
