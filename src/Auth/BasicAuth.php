<?php

namespace JobBoard\Auth;

use Doctrine\DBAL\Driver\PDOException;
use JobBoard\DB\Connection;

class BasicAuth implements Auth
{
    protected $auth;
    protected $queryBuilder;

    public function __construct(Connection $connection)
    {
        $dbh = $connection->connection;
        $this->queryBuilder = $dbh->createQueryBuilder();
    }

    public function authenticate(array $credentials, $remember)
    {
        return $this->auth->authenticate($credentials, $remember);
    }

    public function check()
    {
        return $this->auth->check();
    }

    public function getUser()
    {
        return $this->getUser();
    }

    public function register(array $credentials, bool $callback = null)
    {
        $this->queryBuilder
            ->insert('users')
            ->values(
                array(
                    'username' => '?',
                    'password' => '?',
                    'is_manager' => '?',
                )
            )
            ->setParameter(0, $credentials['username'])
            ->setParameter(1, $credentials['password'])
            ->setParameter(2, $credentials['is_manager']);

        try {
            $this->queryBuilder->execute();
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function login($user, bool $remember)
    {
        return $this->login($user, $remember);
    }

    public function logout($user, bool $everywhere)
    {
        return $this->logout($user, $everywhere);
    }
}