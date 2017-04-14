<?php

namespace JobBoard\Repositories;

use JobBoard\Model\User;

interface UserRepository
{
    public function findById(int $id);
    public function save(User $model);
    public function update(User $model);
    public function getAll();
}