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
    private ListenerProviderInterface $providers;

    public function __construct(ListenerProviderInterface $provider = null) 
    {
        $this->provider = $provider ?? new Provider();
    }

    /**
     * @inheritDoc
     */
    public function dispatch(object $event) : object 
    {
        if(($stoppable = $event instanceof Stoppable)
           && $event->isPropagationStopped())
        {
            return $event;
        }
        
        foreach ($this->provider->getListenersForEvent($event) as $listener)
        {
            $listener($event);
           
            if($stoppable && $event->isPropagationStopped())
            {
                return $event;
            }
        }

        return $event;
    }
    
    /**
     * @inheritDoc
     */
    public function getProvider(): ListenerProviderInterface 
    {
        return $this->provider;
    }
}
