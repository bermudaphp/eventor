<?php

namespace Lobster\Events;

use Throwable;

/**
 * Class ErrorFactory
 * @package Halcyon\EventDispatcher
 */
class ErrorFactory implements ErrorFactoryInterface {

    /**
     * @param Throwable $e
     * @param object $event
     * @param callable $listener
     * @return ErrorInterface
     */
    public function make(Throwable $e, object $event, callable $listener): ErrorInterface {
        return Error::create($e, $event, $listener);
    }
}
