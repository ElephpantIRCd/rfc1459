<?php
namespace ElephpantIRCd\RFC1459;

use ElephpantIRCd\RFC1459\Command\Nick;
use ElephpantIRCd\Connection;
use ElephpantIRCd\Hookable;
use ElephpantIRCd\PluginInterface;
use ElephpantIRCd\RFC1459\Message\AbstractMessage;
use ElephpantIRCd\Server;

class Plugin implements PluginInterface
{
    use Hookable;

    public static function register(Server $server)
    {
        echo 'RFC1459 Plugin Registered Successfully', PHP_EOL;
        $plugin = new static();
        $server->addHook(Server::HOOK_CONNECT, [$plugin, 'onConnect']);
        $server->addHook(Server::HOOK_INPUT, [$plugin, 'onInput']);

        Nick::register($plugin);
    }

    public function onConnect(Server $s, Connection $c, $message)
    {
        // Do things on connections
    }

    public function onInput(Server $server, Connection $connection, $message)
    {
        echo '[ IN] ', $message, PHP_EOL;
        $message = AbstractMessage::parse($message);
        $container = new TriggerContainer($server, $connection, $message);
        $this->triggerHooks($message->getCommand(), ['container' => $container]);
    }
}
