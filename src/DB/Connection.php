<?php


namespace JobBoard\DB;


interface Connection
{
    public function getConnection();
    public function createQueryBuilder();
}