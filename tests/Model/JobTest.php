<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /** @test */
    public function job_instance_has_correct_properties()
    {
        $job = new \JobBoard\Model\Job("PHP Developer", "PHP developer job description.", "koray@koraykupe.com", 1, 1);
        $this->assertInstanceOf(\JobBoard\Model\Job::class, $job);
        $this->assertSame($job->email, "koray@koraykupe.com");
    }
}
