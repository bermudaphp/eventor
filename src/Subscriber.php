<?php


namespace Lobster\Events;


use Psr\Container\ContainerInterface;

/**
 * Class Subscriber
 * @package Lobster\Events
 */
abstract class Subscriber implements SubscriberInterface {

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Subscriber constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param string $service
     * @param string|null $method
     * @return callable
     */
    public function lazy(string $service, string $method = null) : callable {
        return LazyListener::create($this->container, $service, $method);
    }



}