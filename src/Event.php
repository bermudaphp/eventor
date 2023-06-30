<?php

namespace Bermuda\Eventor;

use Psr\EventDispatcher\StoppableEventInterface;

class Event implements StoppableEventInterface 
{
    private array $data = [];
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

    public function set(string $key, $value): Event
    {
        $this->data[$key] = $value;
        return $this;
    }
    
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
    
    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function getData(): array
    {
        return this->data;
    }
}
