<?php

namespace App\Example;

use App\Core\Command\CommandBus as CommandCommandBus;
use App\Core\Command\CommandResult as CommandCommandResult;
use App\Core\CommandBus;
use App\Core\CommandResult;

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

    public function execute(): CommandCommandResult
    {
        return CommandCommandBus::instance()->execute($this);
    }
}
