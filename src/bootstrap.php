<?php declare(strict_types = 1);

require_once  __DIR__ .'/../vendor/autoload.php';

$environment = 'development';

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e) {
        echo 'Todo: Friendly error page';
    });
}
$whoops->register();

// Register HTTP component - Request
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

// Register HTTP component - Response
use Symfony\Component\HttpFoundation\Response;

$response = new Response(
    'Content',
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);

$connection = new \JobBoard\DB\Connection();
$job = new \JobBoard\Job("aa", "ss", "assd", 1);
$jobOffer = new \JobBoard\Observer\PostJobOffer();
$jobOffer->attach(new \JobBoard\Observer\EmailNotifier());
$jobOffer->create($job);

$content = "";
if ($jobOffer)
    $content .= "Job offer created successfully";

$response->setContent($content);

// echo $response->getContent();

// Routes
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $class = new $className;
        $class->$method($vars);
        break;
}








// $job = new \JobBoard\Job("asd"," asd", "adsa");
// print_r($job->create());

$connection = new \JobBoard\DB\Connection();
$job = new \JobBoard\Job("aa", "ss", "assd", 1);
$jobOffer = new \JobBoard\Observer\PostJobOffer();
$jobOffer->attach(new \JobBoard\Observer\EmailNotifier());
$jobOffer->create($job);

/*
$postJob = new \JobBoard\Observer\PostJobOffer();
$postJob->attach(new \JobBoard\Observer\EmailNotifier());
$postJob->create(); */