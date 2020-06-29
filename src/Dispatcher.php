<?php


namespace Lobster\Events;


use Lobster\Events\ListenerProvider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;


/**
 * Class Dispatcher
 * @package Lobster\Events
 */
class Dispatcher implements EventDispatcherInterface 
{
    protected ListenerProviderInterface $providers;

    public function __construct(ListenerProviderInterface $provider) 
    {
        $this->provider = $provider;
    }

    /**
     * @inheritDoc
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
                    $this->catchThrowable($e, $event, $listener);
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
     * @param Throwable $e
     * @param object $event
     * @param callabale $listener
     * @throws Throwable
     */
    private function catchThrowable(Throwable $e, object $event, callable $listener) : void
    {
        if($event instanceof ErrorEvent)
        {
            throw $event->getThrowable();
        }
        
        $this->dispatch(new ErrorEvent($e, $event, $listener));
        
        throw $e;
    }
}
