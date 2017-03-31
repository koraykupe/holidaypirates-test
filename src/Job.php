<?php
namespace JobBoard;

use JobBoard\DB\Connection;

class Job extends Connection
{
    public $title;
    public $description;
    public $email;
    public $status;

    /**
     * Job constructor.
     * @param $title
     * @param $description
     * @param $email
     */
    public function __construct($title, $description, $email, int $status)
    {
        $this->title = $title;
        $this->description = $description;
        $this->email = $email;
        $this->status = $status;

        parent::__construct();
    }
}