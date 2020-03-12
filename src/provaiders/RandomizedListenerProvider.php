<?php


namespace Lobster\Events\providers;

/**
 * Class RandomizedListenerProvider
 * @package Lobster\Events\providers
 */
class RandomizedListenerProvider extends ListenerProvider {
    /**
     * @param object $event
     * @return array
     */
    public function getListenersForEvent(object $event): array {
        return shuffle(parent::getListenersForEvent($event));
    }
}