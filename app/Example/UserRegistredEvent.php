<?php

namespace App\Example;

class UserRegistredEvent
{
    public function __construct(
        protected string $id
    ) {}

    public function id()
    {

    }
}
