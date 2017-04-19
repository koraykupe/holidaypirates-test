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

    /** @test */
    public function get_user_returns_user_object_if_logged_in()
    {
        $auth = new \JobBoard\Auth\BasicAuth($this->userRepository, $this->session);

        $userMock = new stdClass();
        $userMock->id = 1;
        $userMock->email = "koray@koraykupe.com";
        $userMock->password = password_hash('123456', PASSWORD_DEFAULT);

        $this->userRepository->expects($this->once())
            ->method("findByEmail")
            ->will($this->returnValue($userMock));

        $credentials['email'] = 'koray@koraykupe.com.tr';
        $credentials['password'] = "123456";

        $user = $auth->login($credentials);

        $this->assertSame($user, $userMock);
    }
}
