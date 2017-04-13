<?php

namespace JobBoard\Auth;

/**
 * Interface Auth
 *
 * @package JobBoard\Auth
 */
interface Auth
{
    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @param array     $credentials
     * @param bool|null $callback
     * @return mixed
     */
    public function register(array $credentials, bool $callback = null);

    /**
     * @param array $credentials
     * @return
     */
    public function login(array $credentials);

    /**
     * @return mixed
     */
    public function logout();
}
