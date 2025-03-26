<?php

namespace Bermuda\Eventor;

interface EventDispatcherFactoryInterface
{
    /**
     * @param iterable<ListenerProviderInterface> $providers
     * @return EventDispatcherInterface
     */
    public function makeDispatcher(iterable $providers = []): EventDispatcherInterface;
}
