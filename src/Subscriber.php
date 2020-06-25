<?php


namespace Lobster\Events;


use Psr\Container\ContainerInterface;


/**
 * Class Subscriber
 * @package Lobster\Events
 */
abstract class Subscriber implements SubscriberInterface 
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $service
     * @param string|null $method
     * @return callable
     */
    public function lazy(string $service, string $method = null) : callable
    {
        return new LazyListener($this->container, $service, $method);
    }
}
