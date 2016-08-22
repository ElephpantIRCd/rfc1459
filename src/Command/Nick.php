<?php
namespace ElephpantIRCd\RFC1459\Command;

use ElephpantIRCd\Hookable;
use ElephpantIRCd\RFC1459\Message\AbstractMessage;

class Nick implements CommandInterface
{
    /**
     * @param Hookable $hookable
     */
    public static function register($hookable)
    {
        echo 'Nick Command Registered',PHP_EOL;
        $nickCommand = new static();
        $hookable->addHook('NICK', [$nickCommand, 'execute']);
    }

    public function execute(array $data)
    {
        $trigger = $data['container'];
        $message = $trigger->getMessage();

        if ($message->getCommand() != 'NICK') {
            return;
        }

        $nickname = $message->getParams()[0];

        $reply = new AbstractMessage();

        // TODO Username tracking
        $lastUsername = 'Anon';

        $reply->setPrefix($lastUsername);
        $reply->setCommand('NICK');
        $reply->setParams([$nickname]);

        $trigger->getConnection()->send($reply);
    }
}
