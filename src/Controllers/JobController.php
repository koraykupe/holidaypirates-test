<?php
namespace JobBoard\Controllers;

class JobController extends AbstractController
{
    public function showForm()
    {
        $job = new \JobBoard\Job("aa", "ss", "assd", 1);
        $jobOffer = new \JobBoard\Observer\PostJobOffer();
        $jobOffer->attach(new \JobBoard\Observer\EmailNotifier());

        $data = "";
        if ($jobOffer->create($job)) {
            $data = [
                'message' => 'Job offer was saved'
            ];
        }

        $html = $this->renderer->render('Result: {{message}}', $data);
        $this->response->setContent($html);
    }

}