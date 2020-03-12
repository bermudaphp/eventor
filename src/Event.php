<?php

namespace Lobster\Events;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class Event
 * @package Lobster\Events
 */
class Event implements StoppableEventInterface {

    /**
     * @var bool
     */
    private $stop = false;

    /**
     * Is propagation stopped?
     *
     * This will typically only be used by the Dispatcher to determine if the
     * previous listener halted propagation.
     *
     * @return bool
     *   True if the Event is complete and no further listeners should be called.
     *   False to continue calling listeners.
     */
    public function isPropagationStopped() : bool {
        return $this->stop;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     */
    public function stopPropagation() : void {
        $this->stop = true;
    }
}
