<?php

namespace App\Core\Query;

use App\Core\Instance;
use App\Core\Shared;

class QueryMemoMiddleware implements QueryMiddlewareInterface, Shared
{
    use Instance;

    public function __construct( 
        protected QueryMemoStorage $storage,
        protected QueryHandlerProvider $handlers,
    ) {}

    public function ask(object $query, callable $next): ?object 
    {
        $memorable = $this->handlers->provide($query) instanceof QueryMemoInterface;

        if ($memorable) {
            $identity = $this->identify($query);
            if ($this->storage->has($identity)) {
                return $this->storage->get($identity);
            }
        }

        $result = $next($query);

        if ($memorable) {
            $this->storage->set($identity, $result);
        }
        
        return $result;
    }

    protected function identify(object $query): string
    {
        return $query instanceof QueryMemoIdentifyInterface 
            ? $query->memoIdentify($query) 
            : sha1(serialize($query))
        ;
    }
}
