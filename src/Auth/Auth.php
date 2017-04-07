<?php

namespace JobBoard\Auth;

interface Auth
{
    public function authenticate(array $credentials, $remember);
    public function getUser();
    public function register(array $credentials, bool $callback = null);
    public function login($user, bool $remember);
    public function logout();
}