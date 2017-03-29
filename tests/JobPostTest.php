<?php

use PHPUnit\Framework\TestCase;

class JobPostTest extends TestCase
{
    /** @test */
    public function status_is_pending_for_first_job_post()
    {
        $jobPost = new JobPost(
            "PHP developer",
            "We are looking for a PHP developer who has professional experience on PHP and MySQL at least 5 years.",
            "hr@holiday-pirates.com"
        );
    }

    /** @test */
    public function status_is_published_for_first_job_post()
    {
        $jobPost = new JobPost(
            "PHP developer",
            "We are looking for a PHP developer who has professional experience on PHP and MySQL at least 5 years.",
            "hr@holiday-pirates.com"
        );
    }

    /** @test */
    public function manager_can_mark_as_spam_a_pending_post()
    {

    }

    /** @test */
    public function manager_can_approve_a_pending_post()
    {

    }

    /** @test */
    public function user_gets_email_for_first_posting()
    {

    }

    /** @test */
    public function moderator_gets_email_for_first_posting()
    {

    }

    /** @test */
    public function user_does_not_get_email_for_first_posting()
    {

    }

    /** @test */
    public function moderator_does_not_get_email_for_first_posting()
    {

    }
}