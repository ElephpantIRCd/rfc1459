<?php
namespace ElephpantIRCd\RFC1459;

use ElephpantIRCd\RFC1459\Command\Nick;
use ElephpantIRCd\Connection;
use ElephpantIRCd\Hookable;
use ElephpantIRCd\PluginInterface;
use ElephpantIRCd\RFC1459\Command\User;
use ElephpantIRCd\RFC1459\Message\AbstractMessage;
use ElephpantIRCd\Server;

class Plugin implements PluginInterface
{
    use Hookable;

    public static function register(Server $server)
    {
        $plugin = new static();
        $server->addHook(Server::HOOK_CONNECT, [$plugin, 'onConnect']);
        $server->addHook(Server::HOOK_INPUT, [$plugin, 'onInput']);

        User::register($plugin);
        Nick::register($plugin);
    }

    public function onConnect(Server $s, Connection $c, $message)
    {
        // Do things on connections
    }

    public function triggerMessage(Server $server, Connection $connection, AbstractMessage $message)
    {
        $this->triggerHooks(
            'MESSAGE_'.$message->getCommand(),
            ['container' => new TriggerContainer($server, $connection, $message)]
        );
    }

    public function triggerEvent($eventName, $data)
    {
        $this->triggerHooks(
            'EVENT_'.$eventName,
            $data
        );
    }

    public function onInput(Server $server, Connection $connection, $message)
    {
        $message = AbstractMessage::parse($message);
        $this->triggerMessage($server, $connection, $message);
    }
}
