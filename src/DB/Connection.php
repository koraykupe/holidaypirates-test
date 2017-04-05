<?php
namespace JobBoard\DB;

use Doctrine\DBAL\DriverManager;

class Connection
{
    private $connectionParams;
    public function __construct()
    {
        $this->connectionParams = include 'config/db.php';
        $this->connection = DriverManager::getConnection($this->connectionParams);
    }
}
