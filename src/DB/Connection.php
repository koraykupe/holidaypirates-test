<?php declare(strict_types = 1);

namespace JobBoard\DB;

/**
 * Interface Connection
 * @package JobBoard\DB
 */
interface Connection
{
    /**
     * @return mixed
     */
    public function getConnection();

    /**
     * @return mixed
     */
    public function createQueryBuilder();
}