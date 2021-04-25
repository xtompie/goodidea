<?php

namespace App\System;

use Closure;

class CommandBus
{
    protected Closure $chain;

    public static function instance(): CommandBus
    {
        return new CommandBus;
    }

    public function __construct()
    {
        $this->chain = $this->chain($this->middlewares());
    }

    public function execute(object $command)
    {
        return ($this->chain)($command);
    }

    protected function middlewares(): array
    {
        return [
            new CommandEventsMiddleware,
            new CommandExecutorMiddleware,
        ];
    }

    protected function chain($middlewares): Closure
    {
        $chain = static fn () => null;
        while ($middleware = array_pop($middlewares)) {
            $chain = static fn ($command) => $middleware->execute($command, $chain);
        }
        return $chain;
    }
}
