<?php
namespace FastEventManager;

class EventManager
{
    /**
     * @var \SplPriorityQueue[]
     */
    private $listeners = [];

    public function attach($name, callable $callable, $priority = 0)
    {
        if (!isset($this->listeners[$name])) {
            $this->listeners[$name] = new \SplPriorityQueue();
        }
        $this->listeners[$name]->insert($callable, $priority);
    }

    public function trigger($regex, ...$args)
    {
        $events = array_keys($this->listeners);
        $eventsMatched = preg_grep($regex, $events);
        foreach ($eventsMatched as $event) {
            /* @var $listenersQueue \SplPriorityQueue */
            $listenersQueue = $this->listeners[$event];
            foreach ($listenersQueue as $listener) {
                call_user_func($listener, $args);
            }
        }
    }
}
