<?php declare(strict_types = 1);

namespace JobBoard\Repositories;

use JobBoard\DB\Connection;
use JobBoard\Model\Job;

/**
 * Class DbalJobRepository
 * @package JobBoard\Repositories
 */
class DbalJobRepository implements JobRepository
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
    private static $table = 'jobs';

    /**
     * DbalJobRepository constructor.
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
            ->from(self::$table)
            ->where('id = ?')
            ->setParameter(0, $id);
    }

    /**
     * @param Job $model
     * @return Job
     */
    public function create(Job $model)
    {
        $query = $this->queryBuilder->insert(self::$table)
            ->values(array(
                'title' => '?',
                'description' => '?',
                'email' => '?',
                'status' => '?',
                'user_id' => '?',
                )
            )
            ->setParameter(0, $model->title)
            ->setParameter(1, $model->description)
            ->setParameter(2, $model->email)
            ->setParameter(3, $model->status)
            ->setParameter(4, $model->user_id);

        $query->execute();
        $model->id = $this->connection->getConnection()->lastInsertId();
        return $model;
    }

    /**
     * @param int $userId
     * @return int
     */
    public function countUsersJobPosts(int $userId) :int
    {
        $query = $this->queryBuilder
            ->select('count(*) as count')
            ->from(self::$table)
            ->where('user_id = ?')
            ->setParameter(0, $userId);

        return (int)$query->execute()->fetch();

    }

    /**
     * @param int $id
     * @param int $status
     * @return bool
     */
    public function updateStatus(int $id, int $status) :bool
    {
        $query = $this->queryBuilder
            ->select('count(*) as count')
            ->update(self::$table)
            ->set('status', '?')
            ->where('id = ?')
            ->setParameter(0, $status)
            ->setParameter(1, $id);

        return (bool)$query->execute();

    }
}