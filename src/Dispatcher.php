<?php


namespace Lobster\Events;


use Lobster\Events\ListenerProvider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;


/**
 * Class Dispatcher
 * @package Lobster\Events
 */
class Dispatcher implements EventDispatcher 
{
    /**
     * @var ListenerProvider[]
     */
    protected array $providers = [];

    public function __construct(iterable $providers = []) 
    {
        foreach ($providers as $provider)
        {
            $this->attach($provider);
        }
    }

    /**
     * @param ListenerProvider $provider
     * @return EventDispatcher
     */
    public function attach(ListenerProvider $provider) : EventDispatcher 
    {
        $this->providers[$provider->getName()] = $provider;
        return $this;
    }

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     *
     * @throws EventError
     */
    public function dispatch(object $event) : object 
    {
        if($this->providers === [] || ($stoppable = $event instanceof Stoppable)
           && $event->isPropagationStopped())
        {
            return $event;
        }

        foreach ($this->providers as $provider)
        {
            foreach ($provider->getListenersForEvent($event) as $listener)
            {
                try 
                {
                    $listener($event);
                } 
                
                catch (\Throwable $e)
                {
                    throw new EventError($e, $event, $listener);
                }

                if($stoppable && $event->isPropagationStopped())
                {
                    return $event;
                }
            }
        }

        return $event;
    }

    /**
     * @param string $name
     * @return EventDispatcher
     */
    public function detach(string $name) : EventDispatcher
    {
        unset($this->providers[$name]);
        return $this;
    }

    /**
     * @return ListenerProvider[]
     */
    public function getProviders(): array 
    {
        return $this->providers;
    }

    /**
     * @param string $provider
     * @return bool
     */
    public function has(string $provider): bool 
    {
        return array_key_exists($provider, $this->providers);
    }

    /**
     * @param string $name
     * @return ListenerProvider|null
     */
    public function getProvider(string $name) :? ListenerProvider 
    {
        return $this->providers[$name] ?? null ;
    }
}
