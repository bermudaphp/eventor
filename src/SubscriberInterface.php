<?php


namespace Lobster\Events;


/**
 * Interface SubscriberInterface
 * @package Lobster\Events
 */
interface SubscriberInterface
{
    /**
     * @return callable[]
     */
    public function getListeners() : iterable;
}
