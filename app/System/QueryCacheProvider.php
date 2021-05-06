<?php

namespace App\System;

class QueryCacheProvider implements Shared
{
    use Instance;

    protected $cache = [];

    public function clear()
    {
        $this->cache = [];
    }

    public function has(string $key): mixed
    {
        return isset($this->cache[$key]);
    }

    public function get(string $key): mixed
    {
        return $this->cache[$key];
    }

    public function set($key, $val)
    {
        $this->cache[$key] = $val;
    }
}
