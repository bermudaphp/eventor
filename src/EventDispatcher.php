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
     * @param ListenerProvider $provider
     * @return EventDispatcher
     */
    public function attach(ListenerProvider $provider) : EventDispatcher ;

    /**
     * @param string $provider
     * @return EventDispatcher
     */
    public function detach(string $provider) : EventDispatcher ;

    /**
     * @param object $event
     * @return object
     * @throws ErrorInterface
     */
    public function dispatch(object $event) : object ;

    /**
     * @param string $provider
     * @return bool
     */
    public function has(string $provider) : bool ;

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
