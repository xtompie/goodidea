<?php

namespace App\Example;

use App\System\QueryBus;

class UserQuery
{
    public function __construct(
        protected string $id,
    ) {}

    public function id()
    {
        return $this->id;
    }

    public function ask(): UserQueryResponse
    {
        return QueryBus::instance()->ask($this);
    }
}