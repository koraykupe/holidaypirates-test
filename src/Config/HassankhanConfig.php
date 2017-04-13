<?php

namespace JobBoard\Config;

use Noodlehaus\Config as C;

class HassankhanConfig implements Config
{
    protected $config;

    /**
     * HassankhanConfig constructor.
     */
    public function __construct()
    {
        $this->config = C::load(__DIR__ . '/../../config');
    }

    /**
     * @param string $variable
     * @return mixed|null
     */
    public function get(string $variable)
    {
        return $this->config->get($variable);
    }

    /**
     * @param string $variable
     * @param $value
     */
    public function set(string $variable, $value)
    {
        return $this->config->set($variable, $value);
    }
}
