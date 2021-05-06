<?php

namespace App\Example;

use App\System\EventPublicInterface;

class UserRegistredEvent implements EventPublicInterface
{
    public function __construct(
        protected string $id
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
