<?php

namespace App\System;

interface CommandMiddlewareInterface
{
    public function execute(object $command, callable $next): ?object;
}
