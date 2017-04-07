<?php
namespace JobBoard\Controllers;

use JobBoard\Model\User;

class UserController extends AbstractController
{
    public function showForm()
    {
        $html = $this->renderer->render('AddUserForm');
        $this->response->setContent($html);
    }

    public function postForm()
    {
        // Get input data
        $email = $this->request->get('email');
        $password = password_hash($this->request->get('password'), PASSWORD_DEFAULT);

        $user = new User();
        try {
            $user->create($email, $password);
            $data = ["message" => "User has been added."];
        } catch (\Exception $e) {
            $data = ["error" => $e->getMessage()];
        }

        // Send data to renderer to generate html output via templates
        $html = $this->renderer->render('AddUserForm', $data);
        // Send html to response
        $this->response->setContent($html);
    }

}