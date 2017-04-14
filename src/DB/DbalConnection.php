<?php

namespace JobBoard\DB;

use Doctrine\DBAL\DriverManager;
use JobBoard\Config\Config;

class DbalConnection implements Connection
{
    protected $config;
    protected $connection;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->connection = DriverManager::getConnection($this->config->get('database'));
    }

    public function getConnection(array $params)
    {
        return $this->connection;
    }

    public function createQueryBuilder()
    {
        $this->connection->createQueryBuilder();
    }
}