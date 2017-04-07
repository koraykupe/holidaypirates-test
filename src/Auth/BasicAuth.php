<?php

namespace JobBoard\Auth;

use JobBoard\Model\User;
use JobBoard\Session\Session;

class BasicAuth implements Auth
{
    protected $auth;
    protected $queryBuilder;
    protected $user;
    protected $session;

    public function __construct(User $user, Session $session)
    {
        $this->user = $user;
        $this->session = $session;
    }

    public function authenticate(array $credentials, $remember)
    {
       if ($user = $this->login($credentials['email'], $credentials['password'])) {
           $this->session->set('user', $user);
           return true;
       }
       return false;
    }

    public function getUser()
    {
        return $this->session->get('user') ?? null;
    }

    public function register(array $credentials, bool $callback = null) :bool
    {
        return $this->user->create($credentials['email'], $credentials['password']);
    }

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

    public function logout()
    {
        $this->session->remove('user');
    }
}