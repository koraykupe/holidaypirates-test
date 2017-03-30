<?php
namespace JobBoard;

use JobBoard\DB\Connection;

class Job
{
    public $title;
    public $description;
    public $email;
    public $status;
    private $connectionParams;

    /**
     * Job constructor.
     * @param $title
     * @param $description
     * @param $email
     */
    public function __construct($title, $description, $email)
    {
        $this->title = $title;
        $this->description = $description;
        $this->email = $email;

        $this->connectionParams = [
            'dbname' => '',
            'user' => '',
            'password' => '',
            'host' => 'localhost',
            'port' => 3306,
            'charset' => 'utf8',
            'driver' => 'pdo_mysql',
        ];
    }

    public function create()
    {
        $connection = new Connection($this->connectionParams);
        $dbh = $connection->connect();
        $sth = $dbh->query("SELECT * FROM users");
        $users = $sth->fetchAll();
        return $users;
    }
}