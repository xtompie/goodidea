<?php

namespace App\System;

interface QueryMiddlewareInterface
{
    public function ask(object $query, callable $next): ?object;
}
