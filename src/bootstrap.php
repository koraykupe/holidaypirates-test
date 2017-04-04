<?php declare(strict_types = 1);

// $job = new \JobBoard\Job("asd"," asd", "adsa");
// print_r($job->create());

$connection = new \JobBoard\DB\Connection();
$job = new \JobBoard\Job("aa", "ss", "assd", 1);
$jobOffer = new \JobBoard\Observer\PostJobOffer();
$jobOffer->attach(new \JobBoard\Observer\EmailNotifier());
$jobOffer->create($job);

/*
$postJob = new \JobBoard\Observer\PostJobOffer();
$postJob->attach(new \JobBoard\Observer\EmailNotifier());
$postJob->create(); */