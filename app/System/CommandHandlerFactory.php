<?php

namespace App\System;

class CommandHandlerFactory
{
    public static function fromCommand(object $command): object
    {
        $commandClass = get_class($command);
        $handlerClass = substr($commandClass, 0, -strlen('Command')) . 'Handler';
        return new $handlerClass;
    }
}