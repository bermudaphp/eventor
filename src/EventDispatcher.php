<?php


namespace Lobster\Events;


use Psr\EventDispatcher\EventDispatcherInterface;


/**
 * Interface EventDispatcher
 * @package Lobster\Events
 */
interface EventDispatcher extends EventDispatcherInterface 
{
    /**
     * @param object $event
     * @return object
     * @throws EventError
     */
    public function dispatch(object $event) : object ;

    /**
     * @param string $provider
     * @return bool
     */
    public function has(string $provider) : bool ;

    /**
     * @param string $provider
     * @return EventDispatcher
     */
    public function detach(string $provider) : EventDispatcher ;
    
    /**
     * @param ListenerProvider $provider
     * @return EventDispatcher
     */
    public function attach(ListenerProvider $provider) : EventDispatcher ;

    /**
     * @return ListenerProvider[]
     */
    public function getProviders() : iterable ;

    /**
     * @param string $name
     * @return ListenerProvider|null
     */
    public function getProvider(string $name) :? ListenerProvider ;
}
