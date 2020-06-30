<?php


namespace Bermuda\Eventor;


use Psr\Container\ContainerInterface;


/**
 * Class LazyListener
 * @package Bermuda\Eventor
 */
class LazyListener
{
    private string $service;
    private ?string $method;
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container, string $service, string $method = null)
    {
        $this->method    = $method;
        $this->service   = $service;
        $this->container = $container;
    }

    /**
     * @param object $event
     */
    public function __invoke(object $event) : void 
    {
        $listener = $this->container->get($this->service); 
        !$this->method ? $listener($event) : ([$listener, $this->method])($event)
    }
}
