<?php declare(strict_types = 1);

namespace JobBoard\Controllers;

use JobBoard\Auth\Auth;
use JobBoard\Config\Config;
use JobBoard\DB\Connection;
use JobBoard\Template\Renderer;
use JobBoard\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 *
 * @package JobBoard\Controllers
 */
abstract class AbstractController
{
    /**
     * @var static
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var Renderer
     */
    protected $renderer;
    /**
     * @var Auth
     */
    protected $auth;
    /**
     * @var Config
     */
    protected $config;

    /**
     * AbstractController constructor.
     *
     * @param Request    $request
     * @param Response   $response
     * @param Renderer   $renderer
     * @param Validator  $validator
     * @param Auth       $auth
     * @param Connection $connection
     * @param Config     $config
     */
    public function __construct(
        Request $request,
        Response $response,
        Renderer $renderer,
        Validator $validator,
        Auth $auth,
        Config $config
    ) {
    
        $this->request = $request::createFromGlobals();
        $this->response = $response;
        $this->renderer = $renderer;
        $this->validator = $validator;
        $this->auth = $auth;
        $this->config = $config;
    }
}
