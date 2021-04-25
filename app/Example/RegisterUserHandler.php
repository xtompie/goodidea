<?php

namespace App\Example;

use App\System\CommandResult;

class RegisterUserHandler
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