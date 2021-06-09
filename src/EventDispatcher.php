<?php

namespace Bermuda\Eventor;

use Bermuda\Eventor\Provider\Provider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;

/**
 * Class EventDispatcher
 * @package Bermuda\Eventor
 */
final class EventDispatcher implements EventDispatcherInterface 
{
    private array $providers = [];

    public function __construct(iterable $providers = []) 
    {
        foreach($providers as $i => $provider)
        {
            if (!$provider instanceof ListenerProviderInterface)
            {
                throw new \InvalidArgumentException(
                    sprintf('$providers[\'. $i .\'] must be instanceof %s', 
                        ListenerProviderInterface::class
                    )
                );
            }
        }
    }
    
    public function __clone()
    {
        $this->providers = $this->getProviders();
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
    
    /**
     * @return ListenerProviderInterface[]
     */
    public function getProviders(): iterable
    {
        $providers = [];
        
        foreach($this->providers as $provider)
        {
            $providers[] = clone $provider;
        }
        
        return $providers;
    }
    
     /**
     * @param ListenerProviderInterface[] $providers
     * @return EventDispatcherInterface
     * @throws \InvalidArgumentException
     */
    public function withProviders(iterable $providers): EventDispatcherInterface
    {
        return new self($providers);
    }
}
