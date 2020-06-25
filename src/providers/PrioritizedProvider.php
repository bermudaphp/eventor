<?php


namespace Lobster\Events\Providers;


use Lobster\Events\SubscriberInterface;


/**
 * Class PrioritizedProvider
 * @package Lobster\Events\Providers
 */
class PrioritizedProvider extends Provider implements PrioritizedProviderInterface
{
    /**
     * @param string $eventType
     * @param callable $listener
     */
    public function detach(string $eventType, callable $listener): void 
    {
        if(array_key_exists($eventType, $this->listeners))
        {
            foreach ($this->listeners[$eventType] as $i => $v)
            {
                if($listener === $v['listener'])
                {
                    unset($this->listeners[$eventType][$i]);
                    return;
                }
            }
        }
    }

    /**
     * @param object $event
     * @return array[callable]
     */
    public function getListenersForEvent(object $event) : array 
    {
        $listeners = [];

        foreach ($this->listeners as $eventType => $v)
        {
            if($event instanceof $eventType)
            {
                $listeners += $v;
            }
        }

        if($listeners !== [])
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
        if(array_key_exists($eventType, $this->listeners))
        {
            foreach ($this->listeners[$eventType] as $v)
            {
                if($listener === $v['listener'])
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
