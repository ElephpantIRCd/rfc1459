<?php
/**
 * Created by PhpStorm.
 * User: Navarr
 * Date: 2016-08-24
 * Time: 22:08 PM
 */

namespace ElephpantIRCd\RFC1459\Routine;


use ElephpantIRCd\Connection;
use ElephpantIRCd\Server;

interface RoutineInterface
{
    public static function execute(Server $server, Connection $client);
}
