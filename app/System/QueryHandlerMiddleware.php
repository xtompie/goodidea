<?php

namespace App\System;

class QueryHandlerMiddleware implements QueryMiddlewareInterface, Shared
{
    use Instance;

    public function ask(object $query, callable $next): ?object 
    {
        $handler = QueryHandlerProvider::instance()->provide($query);
        return $handler->ask($query);
    }
}
