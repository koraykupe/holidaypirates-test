<?php


namespace JobBoard\Config;

use Noodlehaus\Config as C;

class HassankhanConfig implements Config
{
    protected $config;
    public function __construct()
    {
        $this->config = C::load(__DIR__ . '/../../config');
    }

    public function get(string $variable)
    {
        return $this->config->get($variable);
    }

    public function set(string $variable, $value)
    {
        return $this->config->set($variable, $value);
    }
}
