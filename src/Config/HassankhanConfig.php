<?php

namespace JobBoard\Config;

use Noodlehaus\Config as C;

/**
 * Class HassankhanConfig
 * Configuration Management
 * @package JobBoard\Config
 */
class HassankhanConfig implements Config
{
    /**
     * @var C
     */
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
     * @return mixed|void
     */
    public function set(string $variable, $value)
    {
        return $this->config->set($variable, $value);
    }
}
