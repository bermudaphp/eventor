<?php


namespace Bermuda\Eventor;


use Psr\EventDispatcher\ListenerProviderInterface as BaseProviderInterface;


/**
 * Interface ListenerProviderInterface
 * @package Bermuda\Eventor
 */
interface ListenerProviderInterface extends BaseProviderInterface 
{
    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function listen(string $eventType, callable $listener): void ;
}
