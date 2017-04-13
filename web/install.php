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
 * Migration - DB Installation
 */
$spot = new \JobBoard\DB\Connection(\JobBoard\Config\HassankhanConfig::class);
$spot->connection->mapper('JobBoard\Model\Entity\JobEntity')->migrate();
$spot->connection->mapper('JobBoard\Model\Entity\UserEntity');

echo "Database migration completed. Please delete or rename extension of this file.";