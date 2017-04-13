<?php
return array(
    'url' => 'http://holidaypirates.app',
    'database' => array(
        'driver' => 'pdo_mysql', // pdo_mysql
        'driver_alias' => 'mysql', // mysql
        'path' => dirname(__DIR__).'/../../database/database.sqlite',
        'dbname' => 'holidaypirates',
        'user' => 'homestead',
        'password' => 'secret',
        'host' => 'localhost',
        'port' => 3306,
        'charset' => 'utf8',
    ),
    'email' => array(
        'method' => 'smtp', // smtp, sendmail,
        'host' => 'mail.cpturkiye.com',
        'username' => 'web.cpturkiye', // smtp user
        'password' => 'Cps*.web2017', // smtp pass
        'smtp_secure' => 'ssl', // ssl or tls
        'port' => 465,
        'set_from' => 'web.cpturkiye@cpturkiye.com'
    ),
);