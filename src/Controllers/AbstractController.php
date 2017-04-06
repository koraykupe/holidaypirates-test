<?php

namespace JobBoard\Controllers;

use JobBoard\Template\Renderer;
use JobBoard\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(Request $request, Response $response, Renderer $renderer, Validator $validator)
    {
        $this->request = $request::createFromGlobals();
        $this->response = $response;
        $this->renderer = $renderer;
        $this->validator = $validator;
    }
}