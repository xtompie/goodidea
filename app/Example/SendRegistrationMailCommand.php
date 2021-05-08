<?php

namespace App\Example;

use App\Core\Command\CommandBus;

class SendRegistrationMailCommand
{
    public function __construct(
        protected string $id,
    ) {}

    public function id()
    {
        return $this->id;
    }

    public function execute(): void
    {
        CommandBus::instance()->execute($this);
    }
}
