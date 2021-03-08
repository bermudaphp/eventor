<?php

namespace Bermuda\Eventor;

final class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    /**
     * @inheritDoc
     */
    protected function getInvokables(): array
    {
        return [EventDispatcherInterface::class => EventDispatcher::class];
    }
}
