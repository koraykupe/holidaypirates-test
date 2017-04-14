<?php declare(strict_types = 1);

namespace JobBoard\Auth;
use JobBoard\Model\User;

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
     * @param User $user
     * @param bool|null $callback
     * @return mixed
     * @internal param array $credentials
     */
    public function register(User $user, bool $callback = null);

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
