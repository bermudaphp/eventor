<?php

namespace Bermuda\Eventor;

interface EventDispatcherAwareInterface
{
    public function setDispatcher(EventDispatcherInterface $dispatcher): EventDispatcherAwareInterface ;
}
