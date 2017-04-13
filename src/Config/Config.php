<?php

namespace JobBoard\Config;

interface Config
{
    public function get(string $variable);
    public function set(string $variable, $value);
}
