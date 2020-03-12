<?php


namespace Lobster\Events\Providers;


use Lobster\Events\ListenerProviderInterface;

/**
 * Interface PriorityListenerProviderInterface
 * @package Lobster\Events\providers
 */
interface PrioritizedListenerProviderInterface extends ListenerProviderInterface {

    /**
     * @param string $eventType
     * @param callable $listener
     * @param int $priority
     */
    public function listen(string $eventType, callable $listener, int $priority = 0) : void;
}