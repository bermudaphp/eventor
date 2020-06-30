<?php


namespace Bermuda\Eventor;


use Psr\Container\ContainerInterface;


/**
 * Class Subscriber
 * @package Bermuda\Eventor
 */
abstract class Subscriber implements SubscriberInterface 
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * @param ListenerProvider $provider
     * @return void
     */
    public function subscribe(ListenerProviderInterface $provider): void 
    {
        foreach($this->getListeners() as $event => $listener)
        {
            $provider->listen($event, $listener);
        }
    }

    protected function lazy(string $service, string $method = null) : callable
    {
        return new LazyListener($this->container, $service, $method);
    }
    
     /**
     * @return callable[]
     */
    abstract protected function getListeners(): iterable ;
}
