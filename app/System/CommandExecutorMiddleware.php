<?php

namespace App\System;

class CommandExecutorMiddleware implements CommandMiddlewareInterface
{
    public function execute(object $command, callable $next): ?object 
    {
        $handler = CommandHandlerFactory::fromCommand($command);

        return $handler->execute($command);
    }
}
