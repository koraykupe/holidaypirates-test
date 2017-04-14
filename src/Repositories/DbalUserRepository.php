<?php

namespace JobBoard\Repositories;

use JobBoard\DB\Connection;
use JobBoard\Model\User;

class DbalUserRepository implements UserRepository
{
    protected $connection;
    protected $queryBuilder;
    private $table = 'users';

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function findById(int $id)
    {
        return $this->queryBuilder
            ->from($this->table)
            ->where('id = ?')
            ->setParameter(0, $id);
    }

    public function save(User $model)
    {
        return $this->queryBuilder->insert($this->table)->values(
            array(
                'email' => '?',
                'password' => '?',
                'is_manager' => '?'
            )
        )
            ->setParameter(0, $model->email)
            ->setParameter(1, $model->password)
            ->setParameter(2, $model->is_manager);
    }

    public function update(User $model)
    {
        // TODO: Implement update() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}