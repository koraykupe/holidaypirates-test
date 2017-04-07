<?php

namespace JobBoard\Session;

use Symfony\Component\HttpFoundation\Session\Session as s;

class SymfonySession implements Session
{
    protected $session;

    public function __construct(s $session)
    {
        $this->session = $session;
    }

    public function start()
    {
        return $this->session->start();
    }

    public function get(string $key)
    {
        return $this->session->get($key);
    }

    public function set(string $key, $value)
    {
        return $this->session->set($key, $value);
    }

    public function remove(string $key)
    {
        return $this->session->remove($key);
    }
}