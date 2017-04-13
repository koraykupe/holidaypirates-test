<?php declare(strict_types = 1);

namespace JobBoard\Model;

/**
 * Class User
 *
 * @package JobBoard\Model
 */
class Moderator extends User
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
    }

    /**
     * Get all moderators
     */
    public function getAll()
    {
        return $this->mapper->all()->where(['is_manager' => 1]);
    }

    /**
     * Check whether is a user is moderator or not
     *
     * @param  User $user
     * @return bool
     */
    public function isUserModerator(User $user) :bool
    {
        return $user->is_moderator == 1 ? true : false;
    }
}
