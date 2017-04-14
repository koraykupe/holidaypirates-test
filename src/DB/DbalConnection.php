<?php declare(strict_types = 1);

namespace JobBoard\DB;

use Doctrine\DBAL\DriverManager;
use JobBoard\Config\Config;

/**
 * Class DbalConnection
 * DBAL database abstraction package implementation
 * @package JobBoard\DB
 */
class DbalConnection implements Connection
{
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * DbalConnection constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->connection = DriverManager::getConnection($this->config->get('database'));
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function createQueryBuilder()
    {
        return $this->connection->createQueryBuilder();
    }
}