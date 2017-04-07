<?php
namespace JobBoard\DB;

use Spot\Config;
use Spot\Locator;

class Connection
{
    private $connectionParams;
    public function __construct()
    {
        $this->connectionParams = include 'config/db.php';
        $cfg = new Config();

        // Sqlite
        $cfg->addConnection($this->connectionParams['driver_alias'], $this->connectionParams);
        $this->connection = new Locator($cfg);
    }
}
