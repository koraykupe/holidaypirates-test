<?php declare(strict_types = 1);

namespace JobBoard\Repositories;

use JobBoard\Model\User;

interface UserRepository
{
    public function findById(int $id);
    public function create(User $model);
    public function update(User $model);
    public function getAll();
}