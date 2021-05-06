<?php

namespace App\System;

class CommandHandlerMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, callable $next): ?object 
    {
        $handler = CommandHandlerProvider::instance()->provide($command);
        return $handler->execute($command);
    }
}
