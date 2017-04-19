<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class BasicAuthTest extends TestCase
{
    /** @test */
    public function get_user_returns_null_when_not_logged_in()
    {
        $userRepository = $this->getMockBuilder('JobBoard\Repositories\UserRepository')->getMock();
        $session = $this->getMockBuilder('JobBoard\Session\Session')->getMock();
        $auth = new \JobBoard\Auth\BasicAuth($userRepository, $session);
        $this->assertNull($auth->getUser());
    }
}
