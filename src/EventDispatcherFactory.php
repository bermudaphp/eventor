<?php


namespace Bermuda\Eventor;


/**
 * Class EventDispatcherFactory
 * @package Bermuda\Eventor
 */
class EventDispatcherFactory
{
    public function make(ListenerProviderInterface $provider = null): EventDispatcherInterface
    {
        return new EventDispatcher($provider ?? new Provider\Provider());
    }
}
