<?php


namespace Lobster\Events;


use Psr\EventDispatcher\StoppableEventInterface;


/**
 * Class Event
 * @package Lobster\Events
 */
class Event implements StoppableEventInterface 
{
    private bool $stop = false;

    /**
     * @inheritDoc
     */
    public function stopPropagation() : void 
    {
        $this->stop = true;
    }
    
    /**
     * @inheritDoc
     */
    public function isPropagationStopped() : bool 
    {
        return $this->stop;
    }
}
