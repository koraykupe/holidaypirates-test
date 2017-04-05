<?php
namespace JobBoard\Controllers;

class JobController extends AbstractController
{
    public function showForm()
    {
        $job = new \JobBoard\Job("aa", "ss", "assd", 1);
        $jobOffer = new \JobBoard\Observer\PostJobOffer();
        $jobOffer->attach(new \JobBoard\Observer\EmailNotifier());
        if ($jobOffer->create($job)) {
            $this->response->setContent('Job offer was saved.');
        }
    }

}