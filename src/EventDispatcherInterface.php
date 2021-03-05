<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\EventDispatcherInterface as PsrDispatcherInterface;

/**
 * Interface EventDispatcherInterface
 * @package Bermuda\Eventor
 */
interface EventDispatcherInterface extends PsrDispatcherInterface
{
    /**
     * The dispatcher must be immutable; This method should be implemented in such 
     * a way as to keepthe state of the current instance unchanged and 
     * return an instance with a changed state.
     * @param ListenerProviderInterface $provider
     * @return EventDispatcherInterface
     */
    public function attach(ListenerProviderInterface $provider): EventDispatcherInterface ;
}
