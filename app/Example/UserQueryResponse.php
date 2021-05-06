<?php

namespace App\Example;

class UserQueryResponse
{
    public function __construct(
        protected bool $success,
        protected ?UserModel $user,
        protected array $attributes,
    ) {}

    public function success(): bool
    {
        return $this->success;
    }

    public function user(): UserModel
    {
        return $this->user;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }
}
