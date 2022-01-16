<?php

use ElephpantIRCd\Server;

require_once(__DIR__.'/../vendor/autoload.php');

$server = new Server('irc.localhost');
$server->run();
