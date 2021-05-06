<?php

namespace App\Example;

class UserQueryHandler
{
    public function ask(UserQuery $query): UserQueryResponse
    {
        return new UserQueryResponse(
            true,
            new UserModel(['id' => $query->id()]),
            [
                'foo' => 'bar'
            ],
        );
    }
}
