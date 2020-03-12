<?php

namespace Lobster\Events;

use Throwable;

/**
 * Class Error
 * @package Application\Errors
 */
final class Error extends \Exception implements ErrorInterface {
    
    /**
     * @var object
     */
    private $event;

    /**
     * @var callable
     */
    private $listener;

    /**
     * @param Throwable $e
     * @param object $event
     * @param callable $listener
     * @return Error
     */
    public static function create(Throwable $e, object $event, callable $listener) : self {
        return new static($e, $event, $listener);
    }

    /**
     * @param Throwable $e
     * @param object $event
     * @param callable $listener
     * @throws Error
     */
    public static function throw(Throwable $e, object $event, callable $listener) : void {
        throw static::create($e, $e, $listener);
    }

    /**
     * ErrorEvent constructor.
     * @param Throwable $throwable
     * @param object $event
     * @param callable $listener
     */
    public function __construct(
        Throwable $throwable, 
        object $event,
        callable $listener
    ) {
        parent::__construct(
            $throwable->getMessage(),
            $throwable->getCode(),
            $throwable
        );

        $this->event = $event;
        $this->listener = $listener;
    }
    
    /**
     * @return object
     */
    public function getEvent(): object {
        return $this->event;
    }

    /**
     * @return callable
     */
    public function getListener(): callable {
        return $this->listener;
    }

    /**
     * @return Throwable
     */
    public function getThrowable() : Throwable {
        return $this->getPrevious();
    }
}
