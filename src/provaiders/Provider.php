<?php


namespace Lobster\Events\Providers;


use Lobster\Events\ListenerProviderInterface;
use Lobster\Events\SubscriberInterface;


/**
 * Class Provider
 * @package Lobster\Events\Providers
 */
class Provider implements ListenerProvider {

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $listeners = [];

    /**
     * ListenerProvider constructor.
     * @param string $name
     * @param iterable $listeners
     */
    public function __construct(string $name, iterable $listeners = []) {

        $this->name = $name;

        foreach ($listeners as $type => $listener){
            $this->listen($type, $listener);
        }
    }

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return array[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event) : array {

        $listeners = [];

        foreach ($this->listeners as $eventName => $listener){
            if($event instanceof $eventName){
                $listeners = array_merge($listeners, $listener);
            }
        }

        return $listeners;
    }

    /**
     * @param string $eventType
     * @return bool
     */
    public function hasListeners(string $eventType) : bool {
        return array_key_exists($eventType, $this->listeners);
    }

    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener) : void {
        if(!in_array($listener, $this->listeners[$eventType] ?? [], true)){
            $this->listeners[$eventType][] = $listener;
        }
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param SubscriberInterface $subscriber
     */
    public function subscribe(SubscriberInterface $subscriber): void {
        foreach ($subscriber->getListeners() as $eventType => $listener){
            $this->listen($eventType, $listener);
        };
    }
}
