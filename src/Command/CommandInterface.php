<?php
namespace ElephpantIRCd\RFC1459\Command;

interface CommandInterface
{
    public function execute(array $message);
}
