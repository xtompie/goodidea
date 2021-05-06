<?php

namespace App\System;

class QueryHandlerProvider implements Shared
{
    use Instance;

    protected $handlers = [];

    public function provide(object $query): object
    {
        if (!isset($this->handlers[$query::class])) {
            $this->handlers[$query::class] = $this->factory($query);
        }
        return $this->handlers[$query::class];
    }

    protected function factory(object $query): object
    {
        $handler = $query::class . 'Handler';
        return $handler::instance();
    }
}