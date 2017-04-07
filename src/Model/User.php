<?php

namespace JobBoard\Model;

use JobBoard\DB\Connection;

class User extends Connection
{
    protected $mapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = $this->connection->mapper('JobBoard\Model\Entity\UserEntity');
        $this->mapper->migrate();
    }

    public function find($email, $password)
    {
        return $this->mapper->first(
            [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]
        );
    }

    public function create(string $email, string $password, bool $isManager = false)
    {
        return $this->mapper->create(
            [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'is_manager' => (int)$isManager
            ]
        );
    }
}