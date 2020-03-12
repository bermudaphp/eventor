<?php


namespace Lobster\Events;


use Throwable;


/**
 * Interface ErrorFactoryInterface
 * @package Lobster\Events
 */
interface ErrorFactoryInterface {

    /**
     * @param Throwable $e
     * @param object $event
     * @param callable $listener
     * @return ErrorInterface
     */
    public function make(Throwable $e, object $event, callable $listener) : ErrorInterface ;
}
