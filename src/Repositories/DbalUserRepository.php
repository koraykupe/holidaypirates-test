<?php

namespace JobBoard\Repositories;

use Doctrine\DBAL\DBALException;
use JobBoard\DB\Connection;
use JobBoard\Model\User;

/**
 * Class DbalUserRepository
 * @package JobBoard\Repositories
 */
class DbalUserRepository implements UserRepository
{
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var mixed
     */
    protected $queryBuilder;
    /**
     * @var string
     */
    private static $table = 'users';

    /**
     * DbalUserRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from(self::$table)
            ->where('id = ?')
            ->setParameter(0, $id);
    }

    /**
     * @param string $email
     * @return object
     */
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

    /**
     * @param User $model
     * @return object
     */
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

    /**
     * @param string $select
     * @param string $orderBy
     * @param string $dir
     * @param int $offset
     * @param null $limit
     * @return object
     */
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

    /**
     * @param string $select
     * @param string $orderBy
     * @param string $dir
     * @param int $offset
     * @param null $limit
     * @return object
     */
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