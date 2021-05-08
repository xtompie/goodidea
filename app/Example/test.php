<?php

use App\Core\Command\CommandBus;
use App\Core\Query\QueryBus;
use App\Example\RegisterUserCommand;
use App\Example\UserQuery;

/** @var CommandResult $registration  */
$registration = CommandBus::instance()->execute(new RegisterUserCommand('test@example.com', '1234'));
// vs v2
(new RegisterUserCommand('test@example.com', '1234'))->execute();

/** @var UserModel $user */
$response = QueryBus::instance()->ask(new UserQuery('1'));
// vs v2
$response = (new UserQuery('1'))->ask();
var_dump($response->user());

