<?php

namespace JobBoard\Auth;

/**
 * Interface Auth
 * @package JobBoard\Auth
 */
interface Auth
{
    /**
     * @param array $credentials
     * @param $remember
     * @return mixed
     */
    public function authenticate(array $credentials, $remember);

    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @param array $credentials
     * @param bool|null $callback
     * @return mixed
     */
    public function register(array $credentials, bool $callback = null);

    /**
     * @param $user
     * @param bool $remember
     * @return mixed
     */
    public function login($user, bool $remember);

    /**
     * @return mixed
     */
    public function logout();
}