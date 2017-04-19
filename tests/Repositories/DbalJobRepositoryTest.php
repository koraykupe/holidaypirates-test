<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class DbalJobRepositoryTest extends TestCase
{
    /** @test */
    public function find_by_id_returns_job_with_expected_values()
    {
        $jobRepo = new \JobBoard\Repositories\DbalJobRepository();
    }

    /** @test */
    public function create_returns_job_object_with_id()
    {
    }

    /** @test */
    public function count_users_job_posts_returns_integer()
    {
    }
}
