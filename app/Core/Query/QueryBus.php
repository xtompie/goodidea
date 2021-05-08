<?php

namespace App\Core\Query;

use App\Core\Instance;
use Closure;

class QueryBus
{
    use Instance;

    public function __construct()
    {
        $this->chain = $this->chain($this->middlewares());
    }

    public function ask(object $query): object
    {
        return ($this->chain)($query);        
    }

    protected function middlewares(): array
    {
        return [
            QueryCacheMiddleware::instance(),
            QueryHandlerMiddleware::instance(),
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
