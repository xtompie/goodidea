<?php

namespace App\Core\Command;

use App\Core\Query\QueryCacheProvider;
use App\Core\Instance;
use App\Core\Shared;

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
