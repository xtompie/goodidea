<?php

namespace App\Example;

class SendRegistrationEmailListener
{
    public function __invoke(UserRegistredEvent $event)
    {
        (new SendRegistrationMailCommand($event->id()))->execute();
    }
}
