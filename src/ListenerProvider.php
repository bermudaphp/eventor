<?php


namespace Lobster\Events;


use Psr\EventDispatcher\ListenerProviderInterface;


/**
 * Interface ListenerProviderInterface
 * @package Lobster\Events
 */
interface ListenerProvider extends ListenerProviderInterface 
{
    /**
     * @return string
     */
    public function getName() : string ;
    
    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener) : void ;
}
