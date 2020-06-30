<?php


namespace Bermuda\Eventor;


use Psr\EventDispatcher\EventDispatcherInterface as BaseDispatcherInterface;


/**
 * Interface EventDispatcherInterface
 * @package Bermuda\Eventor
 */
interface EventDispatcherInterface extends BaseDispatcherInterface 
{
    public function getProvider(): ListenerProviderInterface ;
}
