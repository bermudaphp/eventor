<?php

namespace Bermuda\Eventor\Provider;

class RandomizedProvider extends Provider 
{
    /**
     * @inheritDoc
     */
    public function getListenersForEvent(object $event): array 
    {
        return usort(parent::getListenersForEvent($event), static function() {
            return random_int(1, 100) <=> random_int(1, 100);
        });
    }
}
