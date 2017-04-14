<?php declare(strict_types = 1);

namespace JobBoard\Auth;

use JobBoard\Model\User;
use JobBoard\Repositories\UserRepository;
use JobBoard\Session\Session;

/**
 * Class BasicAuth
 *
 * @package JobBoard\Auth
 */
class BasicAuth implements Auth
{
    /**
     * @var
     */
    protected $auth;
    /**
     * @var
     */
    protected $queryBuilder;
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var Session
     */
    protected $session;

    /**
     * BasicAuth constructor.
     *
     * @param UserRepository $userRepository
     * @param Session $session
     */
    public function __construct(UserRepository $userRepository, Session $session)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->session->get('user') ?? null;
    }

    /**
     * @param User $user
     * @param bool|null $callback
     * @internal param array $credentials
     * @return mixed
     */
    public function register(User $user, bool $callback = null)
    {
        return $this->userRepository->create($user);
    }

    /**
     * @param array $credentials
     * @return bool
     * @internal param $user
     * @internal param bool $remember
     */
    public function login(array $credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (password_verify($credentials['password'], $user->password)) {
            $this->session->set('user', $user);
            return true;
        } else {
            $this->logout();
        }
        return false;
    }

    /**
     * Check whether user is manager or not
     *
     * @return bool
     */
    public function isManager()
    {
        return ($this->getUser() && $this->getUser()->is_manager == 1) ? true : false;
    }

    /**
     * Logout user
     */
    public function logout()
    {
        return $this->session->remove('user');
    }
}
