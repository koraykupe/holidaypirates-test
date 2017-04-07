<?php
namespace JobBoard\Observer;

/**
 * Interface Observer
 * @package JobBoard\Observer
 */
interface Observer
{
    /**
     * @return mixed
     */
    public function handle();
}