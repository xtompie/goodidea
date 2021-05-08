<?php

namespace App\Core\Query;

use App\Core\Instance;
use App\Core\Shared;

class QueryHandlerMiddleware implements QueryMiddlewareInterface, Shared
{
    use Instance;

    public function ask(object $query, callable $next): ?object 
    {
        $handler = QueryHandlerProvider::instance()->provide($query);
        return $handler->ask($query);
    }
}
