<?php

namespace Bermuda\Eventor\Provider;

use Bermuda\Eventor\SubscriberInterface;

/**
 * Class PrioritizedProvider
 * @package LBermuda\Eventor\Provider
 */
class PrioritizedProvider extends Provider implements PrioritizedProviderInterface
{
    /**
     * @param object $event
     * @return array[callable]
     */
    public function getListenersForEvent(object $event) : array 
    {
        $listeners = [];

        foreach ($this->listeners as $eventType => $v)
        {
            if ($event instanceof $eventType)
            {
                $listeners += $v;
            }
        }

        if ($listeners !== [])
        {
            usort($listeners, function ($a, $b)
            {
                return $b['priority'] <=> $a['priority'];
            });

            foreach ($listeners as &$listener)
            {
                $listener = $listener['listener'];
            }
        }

        return $listeners;
    }

    /**
     * @param string $eventType
     * @param callable $listener
     * @param int $priority
     */
    public function listen(string $eventType, callable $listener, int $priority = 0): void 
    {
        if (array_key_exists($eventType, $this->listeners))
        {
            foreach ($this->listeners[$eventType] as $v)
            {
                if ($listener === $v['listener'])
                {
                    return;
                }
            }
        } 
        
        else 
        {
            $this->listeners[$eventType] = [];
        }

        $this->listeners[$eventType][] = compact('listener', 'priority');
    }
}
