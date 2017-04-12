<?php

return [
    'driver' => 'pdo_sqlite', // pdo_mysql
    'driver_alias' => 'sqlite', // mysql
    'path' => dirname(__DIR__).'/../../database/database.sqlite',
    'dbname' => '',
    'user' => '',
    'password' => '',
    'host' => 'localhost',
    'port' => 3306,
    'charset' => 'utf8',
];