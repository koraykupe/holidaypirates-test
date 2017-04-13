<?php declare(strict_types = 1);

namespace JobBoard\Controllers;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AuthController
 * @package JobBoard\Controllers
 */
class AuthController extends AbstractController
{
    /**
     * Show user adding form
     */
    public function showRegisterForm()
    {
        $html = $this->renderer->render('AddUserForm');
        $this->response->setContent($html);
    }

    /**
     * Save user and show result
     */
    public function postRegisterForm()
    {
        // Get input data
        $credentials['email'] = $this->request->get('email');
        $credentials['password'] = $this->request->get('password');
        $credentials['isManager'] = (bool)$this->request->get('manager');

        if($this->auth->register($credentials)) {
            $data = ["message" => "User has been added."];
        } else {
            $data = ["error" => "User register error."];
        }

        // Send data to renderer to generate html output via templates
        $html = $this->renderer->render('AddUserForm', $data);
        // Send html to response
        $this->response->setContent($html);
    }

    /**
     * Show user login form
     */
    public function showLoginForm()
    {
        $html = $this->renderer->render('LoginForm');
        $this->response->setContent($html);
    }

    /**
     * Login user or give error
     */
    public function postLoginForm()
    {
        $credentials['email'] = $this->request->get('email');
        $credentials['password'] = $this->request->get('password');

        // Try to login and get user object
        $user = $this->auth->login($credentials);

        // Response messages
        $data = $user ? ["message" => "Login successful"] : ["error" => "E-mail or password wrong"];

        $html = $this->renderer->render('LoginForm', $data);
        // Send html to response
        $this->response->setContent($html);
    }

    public function logout()
    {
        $this->auth->logout();
        $this->response = new RedirectResponse('/auth/login');
    }

}