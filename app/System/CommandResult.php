<?php

namespace App\System;

class CommandResult implements CommandResultHasEventsInterface
{
    public static function withSuccess($events = [])
    {
        return new static(true, [], $events);
    }

    public static function withErrors($errors)
    {
        return new static(true, $errors);
    }

    public static function withError($error)
    {
        return static::withErrors([$error]);
    }

    public function __construct(
        protected bool $success,
        protected array $errors = [],
        protected array $events = []
    ) {}

    public function success(): bool
    {
        return $this->success;
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
