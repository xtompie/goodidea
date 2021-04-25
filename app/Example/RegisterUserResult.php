<?php

namespace App\Example;

class RegisterUserResult
{
    public function __construct(
        protected bool $success,
        protected array $errors
    ) {}
}
