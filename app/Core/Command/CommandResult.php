<?php

namespace App\Core\Command;

class CommandResult implements CommandPublishesEvents
{
    public static function new()
    {
        return new static();
    }

    public function __construct(
        protected bool $success = true,
        protected string|null $resource = null,
        protected array $errors = [],
        protected array $events = []
    ) {}

    public function withSuccess(): static
    {
        $clone = clone $this;
        $clone->success = true;
        return $clone;
    }

    public function withErrors(ErrorCollection $errors): static
    {
        $clone = clone $this;
        $clone->errors = $errors;
        return $clone;
    }

    public function withError($error)
    {
        return $this->withErrors(new ErrorCollection([$error]));
    }

    public function withErrorMessage($message, $key = null)
    {
        return $this->withError(new Error($message, $key));
    }

    public function withEvents(array $events): static
    {
        $clone = clone $this;
        $clone->events = $events;
        return $clone;
    }

    public function withEvent(object $event): static
    {
        return $this->withEvents([$event]);
    }

    public function success(): bool
    {
        return $this->success;
    }
    
    public function resource(): string
    {
        return $this->resource;
    }
    
    public function errors(): array
    {
        return $this->errors;
    }
    
    public function events(): array
    {
        return $this->events;
    }
}
