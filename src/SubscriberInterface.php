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
    public function getListeners() : iterable ;
}
