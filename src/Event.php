<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\StoppableEventInterface;

class Event implements StoppableEventInterface 
{
    private bool $propagationStopped = false;

    /**
     * @inheritDoc
     */
    public function stopPropagation(): void 
    {
        $this->propagationStopped = true;
    }
    
    /**
     * @inheritDoc
     */
    public function isPropagationStopped(): bool 
    {
        return $this->propagationStopped;
    }
}
