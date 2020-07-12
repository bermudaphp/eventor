<?php


namespace Bermuda\Eventor;


/**
 * Interface EventDispatcherFactoryIntreface
 * @package Bermuda\Eventor
 */
interface EventDispatcherFactoryIntreface
{
    public function make(ListenerProviderInterface $provider = null): EventDispatcherInterface ;
}
