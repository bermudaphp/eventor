<?php


namespace Bermuda\Eventor;


/**
 * Class EventDispatcherFactory
 * @package Bermuda\Eventor
 */
interface EventDispatcherFactory
{
    public function make(ListenerProviderInterface $provider): EventDispatcherInterface
    {
    }
}
