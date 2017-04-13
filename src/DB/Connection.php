<?php
namespace JobBoard\DB;

use JobBoard\Config\HassankhanConfig;
use Spot\Config as SpotConfig;
use Spot\Locator;

/**
 * Class Connection
 *
 * @package JobBoard\DB
 */
class Connection
{
    /**
     * @var mixed
     */
    private $connectionParams;
    private $config;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->config = new HassankhanConfig();
        $this->connectionParams = $this->config->get('database');
        $cfg = new SpotConfig();

        // Sqlite
        $cfg->addConnection($this->connectionParams['driver_alias'], $this->connectionParams);
        $this->connection = new Locator($cfg);
    }
}
