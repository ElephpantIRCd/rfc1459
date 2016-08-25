<?php
namespace ElephpantIRCd\RFC1459\Replies;

use ElephpantIRCd\Connection;
use ElephpantIRCd\RFC1459\Message\AbstractMessage;

class MOTDStart implements ReplyInterface
{
    public static function send(Connection $connection, $server)
    {
        $message = new AbstractMessage();
        $message->setCommand(375)
            ->setParams([':-',$server,'Message of the day - ']);

        $connection->send($message);
    }
}
