<?php

namespace App\System;

class CommandHandlerProvider implements Shared
{
    use Instance;

    protected $handlers = [];

    public function provide(object $command): object
    {
        if (!isset($this->handlers[$command::class])) {
            $this->handlers[$command::class] = $this->factory($command);
        }
        return $this->handlers[$command::class];
    }

    protected function factory(object $command): object
    {
        $handler = $command::class . 'Handler';
        return $handler::instance();
    }
}