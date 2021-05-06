<?php

namespace App\System;

class CommandClearQueryCacheMiddleware implements CommandMiddlewareInterface, Shared
{
    use Instance;

    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        QueryCacheProvider::instance()->clear();

        return $result;
    }
}
