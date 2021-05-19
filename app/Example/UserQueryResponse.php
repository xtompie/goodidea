<?php

namespace App\Example;

use App\Core\SerializationInterface;

class UserQueryResponse implements SerializationInterface
{

    public static function fromSerialization(string $archive): static
    {
        $args = (object)json_decode($archive, true);
        return new static($args->success, $args->user, $args->attributes);
    }

    public function toSerialization(): string
    {
        return json_encode([
            'success' => $this->success,
            'user' => $this->user,
            'attributes' => $this->attributes,
        ]);
    }

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
