<?php


namespace Lobster\Events;


use Lobster\Events\ListenerProviderInterface as Provider;
use Psr\EventDispatcher\EventDispatcherInterface;


/**
 * Interface EventDispatcher
 * @package Lobster\Events
 */
interface EventDispatcher extends EventDispatcherInterface {

    /**
     * @param ListenerProviderInterface $provider
     * @return EventDispatcher
     */
    public function attach(Provider $provider) : EventDispatcher;

    /**
     * @param string $provider
     * @return EventDispatcher
     */
    public function detach(string $provider) : EventDispatcher;

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
     * @return ListenerProviderInterface[]
     */
    public function getProviders() : iterable;

    /**
     * @param string $name
     * @return ListenerProviderInterface|null
     */
    public function getProvider(string $name) :? Provider ;
}
