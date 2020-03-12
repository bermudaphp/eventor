<?php

namespace Lobster\Events;

use Psr\EventDispatcher\ListenerProviderInterface as ProviderInterface;

/**
 * Interface ListenerProviderInterface
 * @package Halcyon\EventDispatcher
 */
interface ListenerProviderInterface extends ProviderInterface {

    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener) : void ;

    /**
     * @return string
     */
    public function getName() : string ;

    /**
     * @param SubscriberInterface $subscriber
     */
    public function subscribe(SubscriberInterface $subscriber) : void ;
}
