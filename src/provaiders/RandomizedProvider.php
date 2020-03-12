<?php


namespace Lobster\Events\Providers;


/**
 * Class RandomizedProvider
 * @package Lobster\Events\Providers
 */
class RandomizedProvider extends Provider {
    
    /**
     * @param object $event
     * @return array
     */
    public function getListenersForEvent(object $event): array {
        return shuffle(parent::getListenersForEvent($event));
    }
}
