<?php

namespace Bermuda\Eventor\Provider;

use Bermuda\Eventor\ListenerProviderInterface;

/**
 * Interface PrioritizedListenerProviderInterface
 * @package Bermuda\Eventor\Provider
 */
interface PrioritizedListenerProviderInterface extends ListenerProviderInterface
{
    /**
     * @param string $eventType
     * @param callable $listener
     * @param int $priority
     */
    public function listen(string $eventType, callable $listener, int $priority = 0) : void;
}
