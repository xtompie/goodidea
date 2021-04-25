<?php

namespace App\Example;

class UserModel
{
    public function __construct(
        protected array $data
    ) {}

    public function data(): array
    {
        return $this->data;
    }
}
