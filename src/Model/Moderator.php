<?php declare(strict_types = 1);

namespace JobBoard\Model;
use JobBoard\Model\Traits\CanModerate;

/**
 * Class User
 * @package JobBoard\Model
 */
class Moderator extends User
{
    use CanModerate;

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
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function find($email, $password)
    {
        return $this->mapper->first(
            [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $isManager
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