<?php


namespace Lobster\Events;


use Lobster\Events\ErrorFactoryInterface as Factory;
use Lobster\Events\ListenerProvider;
use Psr\EventDispatcher\StoppableEventInterface as Stoppable;


/**
 * Class Dispatcher
 * @package Lobster\Events
 */
class Dispatcher implements EventDispatcher {

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var ListenerProvider[]
     */
    private $providers = [];

    /**
     * Dispatcher constructor.
     * @param ListenerProvider[] $providers
     * @param ErrorFactoryInterface|null $factory
     */
    public function __construct(iterable $providers = [], Factory $factory = null) {

        foreach ($providers as $provider){
            $this->attach($provider);
        }

        $this->factory = $factory ?? new class implements ErrorFactoryInterface {

            /**
             * @param \Throwable $e
             * @param object $event
             * @param callable $listener
             * @return ErrorInterface
             */
            public function make(\Throwable $e, object $event, callable $listener): ErrorInterface {
                return Error::create($e, $event, $listener);
            }
        };
    }

    public function __clone() {

        $providers = $this->getProviders();

        $this->providers = [];

        foreach ($providers as $provider){
            $this->providers[$provider->getName()] = clone $provider;
        }

    }

    /**
     * @param ListenerProvider $provider
     * @return EventDispatcher
     */
    public function attach(ListenerProvider $provider) : EventDispatcher {

        $dispatcher = clone $this;

        $dispatcher->providers[$provider->getName()] = $provider;

        return $dispatcher;
    }

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     *
     * @throws ErrorInterface
     */
    public function dispatch(object $event) : object {

        if($this->providers === [] ||
            ($stoppable = $event instanceof Stoppable)
            && $event->isPropagationStopped()
        ){
            return $event;
        }

        foreach ($this->providers as $provider){
            foreach ($provider->getListenersForEvent($event) as $listener){

                try {
                    $listener($event);
                } catch (\Throwable $e){
                    throw $this->factory->make($e, $event, $listener);
                }

                if($stoppable && $event->isPropagationStopped()){
                    return $event;
                }
            }
        }

        return $event;
    }

    /**
     * @param string $provider
     * @return EventDispatcher
     */
    public function detach(string $provider) : EventDispatcher {

        $dispatcher = clone $this;

        if($dispatcher->has($provider)){
            unset($this->providers[$provider]);
        }

        return $dispatcher;
    }

    /**
     * @return ListenerProvider[]
     */
    public function getProviders() : iterable {
        return $this->providers;
    }

    /**
     * @param string $provider
     * @return bool
     */
    public function has(string $provider) : bool {
        return array_key_exists($provider, $this->providers);
    }

    /**
     * @param string $name
     * @return ListenerProvider|null
     */
    public function getProvider(string $name) :? ListenerProvider {
        return $this->providers[$name] ?? null ;
    }
}
