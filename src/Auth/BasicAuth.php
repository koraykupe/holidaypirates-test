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
     * @param array $credentials
     * @param $remember
     * @return bool
     */
    public function authenticate(array $credentials, $remember)
    {
       if ($user = $this->login($credentials['email'], $credentials['password'])) {
           $this->session->set('user', $user);
           return true;
       }
       return false;
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
    public function register(array $credentials, bool $callback = null) :bool
    {
        return $this->user->create($credentials['email'], $credentials['password']);
    }

    /**
     * @param $user
     * @param bool $remember
     * @return bool
     */
    public function login($user, bool $remember)
    {
        $user = $this->user->find($user, $remember);

        if ($user) {
            $this->session->set('user', $user);
            return true;
        } else {
            $this->logout();
        }
        return false;
    }

    /**
     *
     */
    public function logout()
    {
        $this->session->remove('user');
    }
}