<?php
namespace JobBoard\Observer;

/**
 * Interface Subject
 * @package JobBoard\Observer
 */
interface Subject
{
    /**
     * @param Observer $observer
     * @return mixed
     */
    public function attach(Observer $observer);

    /**
     * @param $index
     * @return mixed
     */
    public function detach($index);

    /**
     * @return mixed
     */
    public function notify();
}