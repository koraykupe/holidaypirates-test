<?php


class Job
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
    public function __construct($title, $description, $email)
    {
        $this->title = $title;
        $this->description = $description;
        $this->email = $email;
    }

    public function create()
    {
    }
}