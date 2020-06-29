<?php


namespace Bermuda\Eventor;


use Throwable;


/**
 * Class ErrorEvent
 * @package Bermuda\Eventor
 */
final class ErrorEvent extends \RuntimeException
{    
    /**
     * @var callable
     */
    private $listener;
    private object $event;

    public function __construct(Throwable $e, object $event, callable $listener)
    {
        parent::__construct($e->getMessage(), $e->getCode(), $e);
       
        $this->file = $e->getFile();
        $this->line = $e->getLine();
       
        $this->event    = $event;
        $this->listener = $listener;
    }
     
    /**
     * @return object
     */
    public function getEvent(): object 
    {
        return $this->event;
    }

    /**
     * @return callable
     */
    public function getListener(): callable 
    {
        return $this->listener;
    }

    /**
     * @return Throwable
     */
    public function getError() : Throwable 
    {
        return $this->getPrevious();
    }
}
