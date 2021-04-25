<?php

namespace App\System;

class EventBus
{
    protected $listeners;

    public static function instance(): EventBus
    {
        return new EventBus;
    }

    public function __construct()
    {
        $this->listeners = EventListeners::listeners();
    }

    public function publish(object $event)
    {
        $name = get_class($event);
        foreach ((array)$this->listeners[$name] as $index => $listener) {
            if (is_string($listener)) { 
                $lister = new $listener;
                $this->listeners[$name][$index]  = $listener;
            }
            call_user_func($listener, $event);
        }
    }

    public function on($eventName, $callback)
    {
        $this->listeners[$eventName][] = $callback;
    }
}
