<?php
namespace FastEventManager;

class EventManager
{
    private $listeners = [];

    public function attach($name, callable $callable)
    {
        $this->listeners[$name][] = $callable;
    }

    public function trigger($regex, $params)
    {
        $events = array_keys($this->listeners);
        $eventsMatched = preg_grep($regex, $events);
        foreach ($eventsMatched as $event) {
            foreach ($this->listeners[$event] as $single) {
                call_user_func_array($single, $params);
            }
        }
    }
}
