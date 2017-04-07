<?php
namespace JobBoard\DB;

use Spot\Config;
use Spot\Locator;

/**
 * Class Connection
 * @package JobBoard\DB
 */
class Connection
{
    /**
     * @var mixed
     */
    private $connectionParams;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->connectionParams = include 'config/db.php';
        $cfg = new Config();

        // Sqlite
        $cfg->addConnection($this->connectionParams['driver_alias'], $this->connectionParams);
        $this->connection = new Locator($cfg);
    }
}
