<?php declare(strict_types = 1);

$injector = new \Auryn\Injector;

/*
 * We can define dependencies in this page.
 */

// Singleton - DB Connection
$injector->share('JobBoard\DB\Connection');
$injector->alias('JobBoard\DB\Connection', 'JobBoard\DB\DbalConnection');

// Job Repository
$injector->alias('JobBoard\Repositories\JobRepository', 'JobBoard\Repositories\DbalJobRepository');

// User Repository
$injector->alias('JobBoard\Repositories\UserRepository', 'JobBoard\Repositories\DbalUserRepository');


// Singleton - Configuration
// $injector->share('JobBoard\Config\Config');
$injector->alias('JobBoard\Config\Config', 'JobBoard\Config\HassankhanConfig');

// Singleton - Request and Response
$request = $injector->share('Symfony\Component\HttpFoundation\Request');
$response = $injector->share('Symfony\Component\HttpFoundation\Response');

$injector->define(
    'Symfony\Component\HttpFoundation\Response',
    [
    ':content' => 'Content',
    ':status' => \Symfony\Component\HttpFoundation\Response::HTTP_OK,
    ':headers' => array('content-type' => 'text/html'),
    ]
);

// Renderer for Templating
$injector->alias('JobBoard\Template\Renderer', 'JobBoard\Template\TwigRenderer');

$injector->delegate(
    'Twig_Environment',
    function () use ($injector) {
        $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
        $twig = new Twig_Environment($loader);
        return $twig;
    }
);

// Validator
$injector->alias('JobBoard\Validation\Validator', 'JobBoard\Validation\SymfonyValidator');
$injector->alias('JobBoard\Validation\Constraints\Email', 'JobBoard\Validation\SymfonyValidator');

// Auth
$injector->alias('JobBoard\Auth\Auth', 'JobBoard\Auth\BasicAuth');

// Session
$injector->alias('JobBoard\Session\Session', 'JobBoard\Session\SymfonySession');

return $injector;
