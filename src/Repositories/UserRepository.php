<?php declare(strict_types = 1);

namespace JobBoard\Repositories;

use JobBoard\Model\User;

/**
 * Interface UserRepository
 * @package JobBoard\Repositories
 */
interface UserRepository
{
    /**
     * Find user by Id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Get user object and create a database record
     * @param User $model
     * @return mixed
     */
    public function create(User $model);

    /**
     * Get all users
     * @return mixed
     */
    public function getAll();
}