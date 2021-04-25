<?php

use App\Example\RegisterUserCommand;
use App\System\CommandBus;
use App\System\CommandResult;
use App\System\QueryBus;

/** @var CommandResult $registration  */
$registration = CommandBus::instance()->execute(new RegisterUserCommand('test@example.com', '1234'));
// vs v2
(new RegisterUserCommand('test@example.com', '1234'))->execute();
// vs v3
RegisterUserCommand::new('test@example.com', '1234')->execute();

/** @var UserModel $user */
$user = QueryBus::instance()->ask(new UserQuery('1'));
// vs v2
(new UserQuery('1'))->ask();
// vs v3
UserQuery::new('1')->ask();



