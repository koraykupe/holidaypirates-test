<?php

namespace JobBoard\Config;

/**
 * Interface Config
 * Configuration Management
 * @package JobBoard\Config
 */
interface Config
{
    /**
     * @param string $variable
     * @return mixed
     */
    public function get(string $variable);

    /**
     * @param string $variable
     * @param $value
     * @return mixed
     */
    public function set(string $variable, $value);
}
