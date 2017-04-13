<?php

namespace JobBoard\Session;

/**
 * Interface Session
 *
 * @package JobBoard\Session
 */
interface Session
{
    /**
     * @return mixed
     */
    public function start();

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function remove(string $key);
}
