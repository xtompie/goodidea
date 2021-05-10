<?php

namespace App\Example;

use App\Core\Command\CommandBus;
use App\Core\Command\CommandResult;

class RegisterUserCommand
{
    public function __construct(
        protected string $email,
        protected string $pass
    ) {}

    public function email()
    {
        return $this->email;
    }

    public function pass()
    {
        return $this->pass;
    }

    public function execute(): CommandResult
    {
        return CommandBus::instance()->execute($this);
    }
}
