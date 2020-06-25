<?php


namespace Lobster\Events\Providers;


use Lobster\Events\ListenerProvider;


/**
 * Class Provider
 * @package Lobster\Events\Providers
 */
class Provider implements ListenerProvider
{
    protected string $name;
    private array $listeners = [];

    public function __construct(string $name, iterable $listeners = [])
    {
        $this->name = $name;

        foreach ($listeners as $type => $listener)
        {
            $this->listen($type, $listener);
        }
    }
    
    /**
     * @return string
     */
    public function getName(): string 
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getListenersForEvent(object $event) : array 
    {
        $listeners = [];

        foreach ($this->listeners as $eventType => $listener)
        {
            if($event instanceof $eventType)
            {
                $listeners[] = $listener;
            }
        }

        return $listeners;
    }

    /**
     * @param string $eventType
     * @return bool
     */
    public function hasListeners(string $eventType) : bool 
    {
        return array_key_exists($eventType, $this->listeners);
    }

    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener) : void 
    {
        if(!in_array($listener, $this->listeners[$eventType] ?? [], true))
        {
            $this->listeners[$eventType][] = $listener;
        }
    }
}
