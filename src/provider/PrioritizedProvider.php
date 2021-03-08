<?php

namespace Bermuda\Eventor\Provider;

/**
 * Class PrioritizedProvider
 * @package LBermuda\Eventor\Provider
 */
class PrioritizedProvider extends Provider implements PrioritizedListenerProviderInterface
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
            usort($listeners, static function (array $a, array $b)
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
