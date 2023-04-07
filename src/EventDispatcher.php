<?php

namespace Bermuda\Eventor;

use Bermuda\Eventor\Provider\Provider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;

final class EventDispatcher implements EventDispatcherInterface 
{
    private array $providers = [];
    public function __construct(iterable|ListenerProviderInterface $providers = []) 
    {
        foreach(is_iterable($providers) ? $providers : [$providers] as $p) $this->addProvider($p);
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
           && $event->isPropagationStopped()) {
            return $event;
        }
        
        foreach($this->providers as $provider) {
            foreach ($provider->getListenersForEvent($event) as $listener) {
                $listener($event);
                if ($stoppable && $event->isPropagationStopped()) {
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
    public function getProviders(): array
    { 
        foreach($this->providers as $provider) $providers[] = clone $provider;
        return $providers ?? [];
    }
    
    /**
     * @param ListenerProviderInterface $provider
     * @return bool
     */
    public function hasProvider(ListenerProviderInterface $provider): bool
    {
        foreach($this->providers as $p) {
            if ($p === $provider) {
                return true;
            }
        }
        
        return false;
    }
    
    private function addProvider(ListenerProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }
}
