<?php
namespace ElephpantIRCd\RFC1459\Routine;

use ElephpantIRCd\Connection;
use ElephpantIRCd\RFC1459\Replies\MOTDStart;
use ElephpantIRCd\Server;

class MOTD implements RoutineInterface
{
    public static function execute(Server $server, Connection $client)
    {
        MOTDStart::send($client, 'irc.example.org');
        /*
        $message = new AbstractMessage();
        $message->setCommand('372')
            ->setPrefix('irc.example.org')
            ->setParams(['Navarr', ':-', 'This is an example MOTD']);

        $client->send($message);

        $message = new AbstractMessage();
        $message->setCommand('376')
            ->setPrefix('irc.example.org')
            ->setParams(['Navarr', ':End of /MOTD command']);

        $client->send($message);
        */
    }
}
