<?php

namespace JobBoard\Repositories;

use JobBoard\Model\Job;

/**
 * Interface JobRepository
 * @package JobBoard\Repositories
 */
interface JobRepository
{
    /**
     * Find user by Id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Get job object and create a database record
     * @param Job $model
     * @return mixed
     */
    public function create(Job $model);
}