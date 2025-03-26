<?php

namespace Bermuda\Eventor;

final class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    /**
     * @inheritDoc
     */
    protected function getFactories(): array
    {
        return [
            EventDispatcherInterface::class => EventDispatcherFactory::class,
            EventDispatcherFactoryInterface::class => [EventDispatcherFactory::class, 'createFromContainer']
        ];
    }
}
