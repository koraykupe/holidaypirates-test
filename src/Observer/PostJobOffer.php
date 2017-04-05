<?php
namespace JobBoard\Observer;

use Doctrine\DBAL\Driver\PDOException;
use JobBoard\DB\Connection;
use JobBoard\Job;

class PostJobOffer extends Connection implements Subject {

    protected $observers = [];
    protected $connection;

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
        return $this;
    }

    public function detach($index)
    {
        unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->handle();
        }
    }

    public function create(Job $job)
    {
        $dbh = $this->connection;
        $queryBuilder = $dbh->createQueryBuilder();

        $queryBuilder
            ->insert('jobs')
            ->values(
                array(
                    'title' => '?',
                    'description' => '?',
                    'email' => '?',
                    'status' => '?'
                )
            )
            ->setParameter(0, $job->title)
            ->setParameter(1, $job->description)
            ->setParameter(2, $job->email)
            ->setParameter(3, $job->status);

        try {
            $queryBuilder->execute();
            // Call Email Notifier
            $this->notify();
        } catch (PDOException $exception) {
            return false;
        }

        return true;
    }
}