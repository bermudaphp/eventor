<?php


namespace Bermuda\Eventor;


/**
 * Interface SubscriberInterface
 * @package Bermuda\Eventor
 */
interface SubscriberInterface
{
    /**
     * @param ListenerProviderInterface $provider
     */
    public function subscribe(ListenerProviderInterface $provider): void ;
}
