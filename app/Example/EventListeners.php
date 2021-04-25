<?php

namespace App\Example;

class EventListeners
{
    public static function listeners(): array
    {
        return [
            UserRegistredEvent::class => [
                SendRegistrationEmailListener::class,
            ]
        ];
    }
}
