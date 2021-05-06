<?php

namespace App\Example;

use App\System\CommandResult;

class RegisterUserCommandHandler
{
    public function execute(RegisterUserCommand $command): CommandResult
    {
        $command->email();
        $command->pass();
        $id = "1234";

        return CommandResult::withSuccess([
            new UserRegistredEvent($id)
        ]);
    }
}