<?php

namespace App\Core\Query;

interface QueryMiddlewareInterface
{
    public function ask(object $query, callable $next): ?object;
}
