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
    $whoops->pushHandler(
        function ($e) {
            echo 'Todo: Friendly error page';
        }
    );
}
$whoops->register();

/*
 * Start a session
 */
$session = new \Symfony\Component\HttpFoundation\Session\Session();

/*
 * Dependency Injection
 */
$injector = include 'Dependencies.php';

$request = $injector->make('Symfony\Component\HttpFoundation\Request');
$response = $injector->make('Symfony\Component\HttpFoundation\Response');
$request = $request::createFromGlobals();

/**
 * Routes
 *
 * @param \FastRoute\RouteCollector $r
 */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include 'Routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

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

        $class = $injector->make($className);

        $class->$method($vars);
        break;
}

echo $response->getContent();
