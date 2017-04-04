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

echo $response->getContent();

exit;








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