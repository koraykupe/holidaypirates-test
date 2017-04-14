<?php

namespace JobBoard\Repositories;

use JobBoard\DB\Connection;
use JobBoard\Model\Job;

class DbalJobRepository implements JobRepository
{
    protected $connection;
    protected $queryBuilder;
    private $table = 'jobs';

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

    public function save(Job $model)
    {
        /*
        if ($this->countUsersJobPosts($this->user_id) == 0) {
            $status = 0;
            // If this is first job posting of the user attach email notifier event
            $this->attach(new EmailNotifierForUser($this));
        } else {
            $status = 1;
        }
        $this->attach(new EmailNotifierForModerator($user));
        $this->notify();
        */
        return $this->queryBuilder->insert($this->table)->values(
            array(
                'title' => '?',
                'description' => '?',
                'email' => '?',
                'status' => '?',
                'user_id' => '?'
            )
        )
            ->setParameter(0, $model->title)
            ->setParameter(1, $model->description)
            ->setParameter(2, $model->email)
            ->setParameter(3, $model->status)
            ->setParameter(4, $model->user_id);
    }

    public function update(Job $model)
    {
        // TODO: Implement update() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}