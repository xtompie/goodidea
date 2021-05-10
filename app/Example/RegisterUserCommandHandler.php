<?php

namespace App\Example;

use App\Core\Command\CommandResult;

class RegisterUserCommandHandler
{
    public function execute(RegisterUserCommand $command): CommandResult
    {
        $command->email();
        $command->pass();
        $id = "1234";

        return CommandResult::new()->withSuccess([
            new UserRegistredEvent($id)
        ]);
    }
}