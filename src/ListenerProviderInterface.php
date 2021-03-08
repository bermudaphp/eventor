<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\ListenerProviderInterface as PsrProviderInterface;

/**
 * Interface ListenerProviderInterface
 * @package Bermuda\Eventor
 */
interface ListenerProviderInterface extends PsrProviderInterface 
{
    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener): void ;
}
