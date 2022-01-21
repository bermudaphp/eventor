<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\StoppableEventInterface;

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
