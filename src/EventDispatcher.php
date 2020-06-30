<?php


namespace Bermuda\Eventor;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
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

        return $event;
    }
    
    public function getProvider(): ListenerProviderInterface 
    {
        return $this->provider;
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
