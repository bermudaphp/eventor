<?php


namespace Bermuda\Eventor;


/**
 * Interface SubscriberInterface
 * @package Bermuda\Eventor
 */
interface SubscriberInterface
{
    /**
     * @return callable[]
     */
    public function subscribe(ListenerProviderInterface $provider): void ;
}
