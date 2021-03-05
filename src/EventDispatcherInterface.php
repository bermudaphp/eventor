<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\EventDispatcherInterface as PsrDispatcherInterface;

/**
 * Interface EventDispatcherInterface
 * @package Bermuda\Eventor
 */
interface EventDispatcherInterface extends PsrDispatcherInterface
{
    public function attach(ListenerProviderInterface $provider): EventDispatcherInterface ;
}
