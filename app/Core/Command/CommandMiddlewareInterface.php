<?php

namespace App\Core\Command;

interface CommandMiddlewareInterface
{
    public function execute(object $command, callable $next): ?object;
}
