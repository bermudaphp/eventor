<?php


namespace Lobster\Events\Providers;


/**
 * Class RandomizedProvider
 * @package Lobster\Events\Providers
 */
class RandomizedProvider extends Provider 
{
    /**
     * @inheritDoc
     */
    public function getListenersForEvent(object $event): array 
    {
        return shuffle(parent::getListenersForEvent($event));
    }
}
