<?php

namespace App\Example;

class SendRegistrationEmailListener
{
    public function __invoke(UserRegistredEvent $event)
    {
        // CommandBus::instance()->execute(
        //     new SendRegistrationMailCommand($event->id())            
        // );
    }
}
