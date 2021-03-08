<?php

namespace Bermuda\Eventor;

use Bermuda\Eventor\Provider\Provider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;

/**
 * Class EventDispatcher
 * @package Bermuda\Eventor
 */
class EventDispatcher implements EventDispatcherInterface 
{
    private array $providers = [];

    public function __construct(iterable $providers = []) 
    {
        foreach($providers as $provider)
        {
            $this->attach($provider);
        }
    }
    
    public function __clone()
    {
        foreach($this->providers as &$provider)
        {
            $provider = clone $provider;
        }
    }

    /**
     * @inheritDoc
     */
    public function dispatch(object $event): object 
    {
        if (($stoppable = $event instanceof Stoppable)
           && $event->isPropagationStopped())
        {
            return $event;
        }
        
        foreach($this->providers as $provider)
        {
            foreach ($provider->getListenersForEvent($event) as $listener)
            {
                $listener($event);

                if ($stoppable && $event->isPropagationStopped())
                {
                    return $event;
                }
            }
        }
        
        return $event;
    }
    
    /**
     * @inheritDoc
     */
    public function attach(ListenerProviderInterface $provider): EventDispatcherInterface
    {
        $copy = clone $this;
        $copy->providers[] = $provider;
        
        return $copy;
    }
}
