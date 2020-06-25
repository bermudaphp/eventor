<?php


namespace Lobster\Events;


/**
 * Interface SubscriberInterface
 * @package Lobster\Events
 */
interface SubscriberInterface
{
    public function subscribe(ListenerProvider $provider) : void;
}
