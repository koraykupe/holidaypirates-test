<?php declare(strict_types = 1);

namespace JobBoard\Session;

use Symfony\Component\HttpFoundation\Session\Session as s;

/**
 * Class SymfonySession
 * @package JobBoard\Session
 * HTTPFoundation package implementation for session management
 */
class SymfonySession implements Session
{
    /**
     * @var s
     */
    protected $session;

    /**
     * SymfonySession constructor.
     * @param s $session
     */
    public function __construct(s $session)
    {
        $this->session = $session;
    }

    /**
     * @return bool
     */
    public function start()
    {
        return $this->session->start();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->session->get($key);
    }

    /**
     * @param string $key
     * @param $value
     * @return mixed|void
     */
    public function set(string $key, $value)
    {
        return $this->session->set($key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function remove(string $key)
    {
        return $this->session->remove($key);
    }
}