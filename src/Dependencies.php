<?php declare(strict_types = 1);

$injector = new \Auryn\Injector;

// Singleton - DB Connection
$injector->share('JobBoard\DB\Connection');

$injector->define('JobBoard\DB\Connection', [
    ':configuration' => $injector->make('Doctrine\DBAL\Configuration'),
]);

// Singleton - Request and Response
$request = $injector->share('Symfony\Component\HttpFoundation\Request');
$response = $injector->share('Symfony\Component\HttpFoundation\Response');

$injector->define('Symfony\Component\HttpFoundation\Response', [
    ':content' => 'Content',
    ':status' => \Symfony\Component\HttpFoundation\Response::HTTP_OK,
    ':headers' => array('content-type' => 'text/html'),
]);

// $injector->make('JobController');

/*
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');
*/

return $injector;