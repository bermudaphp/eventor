<?php


namespace Lobster\Events;


use Psr\EventDispatcher\ListenerProviderInterface;


/**
 * Interface ListenerProviderInterface
 * @package Lobster\Events
 */
interface ListenerProvider extends ListenerProviderInterface {

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
