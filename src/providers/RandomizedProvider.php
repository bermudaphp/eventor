<?php


namespace Bermuda\Eventor\Provider;


/**
 * Class RandomizedProvider
 * @package Bermuda\Eventor\Provider
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
