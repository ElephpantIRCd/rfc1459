<?php
namespace ElephpantIRCd\RFC1459\Command;

use ElephpantIRCd\RFC1459\Routine\MOTD;
use ElephpantIRCd\RFC1459\TriggerContainer;

class User implements CommandInterface
{
    public static function register($hookable)
    {
        $userCommand = new static();
        $hookable->addHook('MESSAGE_USER', [$userCommand, 'execute']);
    }

    public function execute(array $data)
    {
        /** @var TriggerContainer $trigger */
        $trigger = $data['container'];
        $message = $trigger->getMessage();

        if ($message->getCommand() != 'USER') {
            return;
        }

        $params = $message->getParams();
        if (count($params) < 4) {
            die('Invalid # of Params for USER Command');
        }
        $username = array_shift($params);
        $hostname = array_shift($params);
        $servername = array_shift($params);
        $realname = array_shift($params);

        MOTD::execute($trigger->getServer(), $trigger->getConnection());
    }
}
