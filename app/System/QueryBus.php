<?php

namespace App\System;

class QueryBus
{
    public static function instance(): QueryBus
    {
        return new QueryBus;
    }

    public function ask(object $query)
    {
    }

}
