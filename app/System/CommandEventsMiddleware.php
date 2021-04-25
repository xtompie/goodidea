<?php

namespace App\System;

class CommandEventsMiddleware implements CommandMiddlewareInterface
{
    public function execute(object $command, $next): ?object 
    {
        $result = $next($command);

        if ($result instanceof CommandResultHasEventsInterface) {
            /** @var CommandResultHasEventsInterface $result */
            foreach ($result->events() as $event) {
                EventBus::instance()->publish($event);
            }
        }

        return $result;
    }
}
