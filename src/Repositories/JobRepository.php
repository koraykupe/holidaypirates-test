<?php

namespace JobBoard\Repositories;

use JobBoard\Model\Job;

interface JobRepository
{
    public function findById(int $id);
    public function save(Job $model);
    public function update(Job $model);
    public function getAll();
}