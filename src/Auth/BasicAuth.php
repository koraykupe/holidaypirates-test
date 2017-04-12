<?php

namespace JobBoard\Auth;

use JobBoard\Model\User;
use JobBoard\Session\Session;

/**
 * Class BasicAuth
 * @package JobBoard\Auth
 */
class BasicAuth implements Auth
{
    /**
     * @var
     */
    protected $auth;
    /**
     * @var
     */
    protected $queryBuilder;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Session
     */
    protected $session;

    /**
     * BasicAuth constructor.
     * @param User $user
     * @param Session $session
     */
    public function __construct(User $user, Session $session)
    {
        $this->user = $user;
        $this->session = $session;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->session->get('user') ?? null;
    }

    /**
     * @param array $credentials
     * @param bool|null $callback
     * @return bool
     */
    public function register(array $credentials, bool $callback = null)
    {
        try {
            $this->user->create($credentials['email'], $credentials['password'], $credentials['isManager']);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param array $credentials
     * @return bool
     * @internal param $user
     * @internal param bool $remember
     */
    public function login(array $credentials)
    {
        $user = $this->user->find($credentials['email']);

        if (password_verify($credentials['password'], $user->password)) {
            $this->session->set('user', $user);
            return true;
        } else {
            $this->logout();
        }
        return false;
    }

    /**
     * Check whether user is manager or not
     * @return bool
     */
    public function isManager()
    {
        return ($this->getUser() && $this->getUser()->is_manager == 1) ? true : false;
    }

    /**
     * Logout user
     */
    public function logout()
    {
        return $this->session->remove('user');
    }
}