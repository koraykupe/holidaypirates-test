<?php

namespace JobBoard\Session;

interface Session
{
    public function start();
    public function get(string $key);
    public function set(string $key, $value);
    public function remove(string $key);
}