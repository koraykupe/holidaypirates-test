<?php

namespace JobBoard\Model;

use JobBoard\DB\Connection;

/**
 * Class User
 *
 * @package JobBoard\Model
 */
class User extends Connection
{
    /**
     * @var \Spot\Mapper
     */
    protected $mapper;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->mapper = $this->connection->mapper('JobBoard\Model\Entity\UserEntity');
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function find($email, $password = null)
    {
        $data['email'] = $email;
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        return $this->mapper->first($data);
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool   $isManager
     * @return object
     */
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
