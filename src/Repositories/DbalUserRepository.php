<?php

namespace JobBoard\Repositories;

use Doctrine\DBAL\DBALException;
use JobBoard\DB\Connection;
use JobBoard\Model\User;

class DbalUserRepository implements UserRepository
{
    protected $connection;
    protected $queryBuilder;
    private static $table = 'users';

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function findById(int $id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from(self::$table)
            ->where('id = ?')
            ->setParameter(0, $id);
    }

    public function findByEmail(string $email)
    {
        $query = $this->queryBuilder
            ->select('*')
            ->from(self::$table)
            ->where('email = ?')
            ->setParameter(0, $email)
            ->setMaxResults(1);

        return (object)$query->execute()->fetch();
    }

    public function create(User $model)
    {
        $query = $this->queryBuilder->insert(self::$table)->values(
            array(
                'email' => '?',
                'password' => '?',
                'is_manager' => '?'
            )
        )
            ->setParameter(0, $model->email)
            ->setParameter(1, password_hash($model->password, PASSWORD_DEFAULT))
            ->setParameter(2, $model->isManager);

        return (object)$query->execute();
    }

    public function update(User $model)
    {
        // TODO: Implement update() method.
    }

    public function getAll($select = '*', $orderBy = 'id', $dir = 'ASC', $offset = 0, $limit = null)
    {
        $query = $this->queryBuilder
            ->select($select)
            ->from(self::$table)
            ->orderBy($orderBy, $dir)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return (object)$query->execute()->fetchAll();
    }

    public function getAllModerators($select = '*', $orderBy = 'id', $dir = 'ASC', $offset = 0, $limit = null)
    {
        $query = $this->queryBuilder
            ->select($select)
            ->from(self::$table)
            ->where('is_manager = 1')
            ->orderBy($orderBy, $dir)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return (object)$query->execute()->fetchAll();
    }
}