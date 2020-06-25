<?php


namespace Lobster\Events\Providers;


use Lobster\Events\ListenerProvider;


/**
 * Interface PriorityListenerProviderInterface
 * @package Lobster\Events\Providers
 */
interface PrioritizedProviderInterface extends ListenerProvider
{
    /**
     * @param string $eventType
     * @param callable $listener
     * @param int $priority
     */
    public function listen(string $eventType, callable $listener, int $priority = 0) : void;
}
