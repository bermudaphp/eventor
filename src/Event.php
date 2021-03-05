<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Class Event
 * @package Bermuda\Eventor
 */
class Event implements StoppableEventInterface 
{
    private bool $stop = false;

    /**
     * @inheritDoc
     */
    public function stopPropagation(): void 
    {
        $this->stop = true;
    }
    
    /**
     * @inheritDoc
     */
    public function isPropagationStopped(): bool 
    {
        return $this->stop;
    }
}
