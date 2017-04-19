<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class BasicAuthTest extends TestCase
{
    private $userRepository;
    private $session;

    public function setUp() {
        $this->userRepository = $this->getMockBuilder('JobBoard\Repositories\UserRepository')->getMock();
        $this->session = $this->getMockBuilder('JobBoard\Session\Session')->getMock();
    }
    /** @test */
    public function get_user_returns_null_when_not_logged_in()
    {
        $auth = new \JobBoard\Auth\BasicAuth($this->userRepository, $this->session);
        $this->assertNull($auth->getUser());
    }
}
