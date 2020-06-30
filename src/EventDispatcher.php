<?php


namespace Bermuda\Eventor;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;


/**
 * Class EventDispatcher
 * @package Bermuda\Eventor
 */
class EventDispatcher implements EventDispatcherInterface 
{
    private ListenerProviderInterface $providers;

    public function __construct(ListenerProviderInterface $provider) 
    {
        $this->provider = $provider;
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
        
        foreach ($provider->getListenersForEvent($event) as $listener)
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
