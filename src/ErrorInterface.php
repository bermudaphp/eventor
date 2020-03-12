<?php


namespace Lobster\Events;


/**
 * Interface ErrorInterface
 * @package Lobster\Events
 */
interface ErrorInterface extends \Throwable {

    /**
     * @return object
     */
    public function getEvent(): object ;

    /**
     * @return callable
     */
    public function getListener(): callable ;
    
    /**
     * @return \Throwable
     */
    public function getThrowable() : \Throwable;
}
