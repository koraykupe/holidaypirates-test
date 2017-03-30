<?php
namespace JobBoard\DB;

class Connection
{
    private $connectionParams;
    public function __construct()
    {
        $this->connectionParams = include 'config/db.php';
    }

    public function connect() {
        $config = new \Doctrine\DBAL\Configuration();
        return \Doctrine\DBAL\DriverManager::getConnection($this->connectionParams, $config);
    }

}