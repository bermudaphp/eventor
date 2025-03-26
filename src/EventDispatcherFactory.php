<?php

namespace Bermuda\Eventor;

use Psr\Container\ContainerInterface;
use function Bermuda\Config\conf;

final class EventDispatcherFactory implements EventDispatcherFactoryInterface
{
    public const string CONFIG_LISTENER_PROVIDERS_KEY = 'Bermuda\Eventor::providers';

    public function __invoke(ContainerInterface $container): EventDispatcherInterface
    {
        return $this->makeDispatcher(conf($container)->get(self::CONFIG_LISTENER_PROVIDERS_KEY, []));
    }

    public function makeDispatcher(iterable $providers = []): EventDispatcherInterface
    {
        return new EventDispatcher($providers);
    }

    public static function createFromContainer(ContainerInterface $container): self
    {
        return new self();
    }
}
