<?php

namespace Bermuda\Eventor\Provider;

use Bermuda\Eventor\ListenerProviderInterface;

class Provider implements ListenerProviderInterface
{
    protected array $listeners = [];
    public function __construct(iterable $listeners = [])
    {
        foreach ($listeners as $type => $listener) $this->listen($type, $listener);
    }
    
    /**
     * @inheritDoc
     */
    public function getListenersForEvent(object $event): array 
    {
        foreach ($this->listeners as $eventType => $listener) {
            if ($event instanceof $eventType) $listeners[] = $listener;
        }

        return $listeners ?? [];
    }

    public function listen(string $eventType, callable $listener): void 
    {
        if (!in_array($listener, $this->listeners[$eventType] ?? [], true)) {
            $this->listeners[$eventType][] = $listener;
        }
    }
}
