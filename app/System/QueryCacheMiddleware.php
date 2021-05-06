<?php

namespace App\System;

class QueryCacheMiddleware implements QueryMiddlewareInterface, Shared
{
    use Instance;

    public function ask(object $query, callable $next): ?object 
    {
        $handler = QueryHandlerProvider::instance()->provide($query);

        if ($handler instanceof QueryCacheInterface) {
            $checksum = sha1(serialize($query));
            $cache = QueryCacheProvider::instance();            
            if ($cache->has($checksum)) {
                return $cache->get($checksum);
            }
        }

        $result = $next($query);

        if ($handler instanceof QueryCacheInterface) {
            $cache->set($checksum, $result);
        }
        
        return $result;
    }
}
