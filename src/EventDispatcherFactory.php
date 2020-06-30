<?php


namespace Bermuda\Eventor;


use Bermuda\Eventor\Provider\Provider;


/**
 * Class EventDispatcherFactory
 * @package Bermuda\Eventor
 */
interface EventDispatcherFactory
{
    public function make(ListenerProviderInterface $provider = null): EventDispatcherInterface
    {
        return new EventDispatcher($provider ?? new Provider());
    }
}
