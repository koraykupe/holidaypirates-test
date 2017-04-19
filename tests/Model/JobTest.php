<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /** @test */
    public function status_is_pending_for_first_job_post()
    {
        $job = new \JobBoard\Model\Job("PHP Developer", "PHP developer job description.", "koray@koraykupe.com", 1, 1);
        $this->assertInstanceOf(\JobBoard\Model\Job::class, $job);
        $this->assertTrue($job->email, "koray@koraykupe.com");
    }
}
