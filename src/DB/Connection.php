<?php


namespace JobBoard\DB;


interface Connection
{
    public function getConnection(array $config);
    public function createQueryBuilder();
}